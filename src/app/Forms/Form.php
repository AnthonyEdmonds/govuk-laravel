<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Exceptions\FormNotFoundException;
use AnthonyEdmonds\GovukLaravel\Exceptions\QuestionNotFoundException;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

// TODO Support for question sections
// TODO Support for task page

abstract class Form
{
    use AuthorizesRequests;

    public const NEW = 'new';
    public const REVIEW = 'review';
    public const EDIT = 'edit';
    public const MODES = [
        self::NEW,
        self::REVIEW,
        self::EDIT,
    ];

    // Abstract
    abstract public static function key(): string;

    abstract public function checkAccess(): void;

    abstract public function questions(): array;

    abstract protected function makeNewSubject(): Model;

    abstract protected function submitForm(Model $subject, string $mode): void;

    abstract protected function confirmationBlade(): string;

    // Static
    public static function getForm(string $key): Form
    {
        $registeredForms = config('govuk.forms', []);

        foreach ($registeredForms as $form) {
            if ($form::key() === $key) {
                return new $form();
            }
        }

        throw new FormNotFoundException("The \"$key\" form has not been registered");
    }

    // Start
    public function start(): Page
    {
        return GovukPage::start(
            $this->startTitle(),
            $this->startBlade(),
            [],
            $this->startRoute(),
            $this->startButtonLabel(),
            'post'
        )
            ->setBack($this->exitRoute());
    }

    public function create(): RedirectResponse
    {
        GovukForm::put(static::key(), $this->makeNewSubject());

        return redirect($this->questionRoute(self::NEW, $this->getFirstQuestionKey()));
    }

    public function edit(int|string $subjectKey): RedirectResponse
    {
        GovukForm::put(static::key(), $this->loadSubjectFromDatabase($subjectKey));

        return redirect($this->summaryRoute(self::EDIT));
    }

    protected function startTitle(): string
    {
        return 'Begin your application';
    }

    protected function startBlade(): string|null
    {
        return null;
    }

    protected function startButtonLabel(): string
    {
        return 'Start';
    }

    // Question
    public function question(string $mode, string $questionKey): Page
    {
        $questionClass = $this->getQuestion($questionKey);
        $subject = $this->getSubjectFromSession();
        $question = $questionClass->getQuestion($subject);

        return is_array($question) === true
            ? GovukPage::questions(
                $questionClass->getTitle($subject),
                $question,
                $this->getSubmitButtonLabel($mode, $questionKey),
                $this->questionRoute($mode, $questionKey),
                $this->getBackRoute($mode, $questionKey),
                $this->getMethod(),
                $this->getBlade(),
                $this->getOtherButtonLabel(),
                $this->getOtherButtonRoute(),
                $this->getSubmitButtonType(),
            )->with('subject', $subject)
            : GovukPage::question(
                $question,
                $this->getSubmitButtonLabel($mode, $questionKey),
                $this->questionRoute($mode, $questionKey),
                $this->getBackRoute($mode, $questionKey),
                $this->getMethod(),
                $this->getBlade(),
                $this->getOtherButtonLabel(),
                $this->getOtherButtonRoute(),
                $this->getSubmitButtonType(),
            )->with('subject', $subject);
    }

    public function store(Request $request, string $mode, string $questionKey): RedirectResponse
    {
        $question = $this->getQuestion($questionKey);
        $subject = $this->getSubjectFromSession();

        $question->validate($request);
        $question->store($request, $subject, $mode);
        GovukForm::put(static::key(), $subject);

        return redirect($this->getNextRoute($mode, $questionKey));
    }

    protected function getSubmitButtonLabel(string $mode, string $questionKey): string
    {
        if ($mode === static::REVIEW || $mode === static::EDIT) {
            return 'Save and back';
        }

        if ($this->isLastQuestion($questionKey) === true) {
            return 'Save and review';
        }

        return 'Save and continue';
    }

    protected function getMethod(): string
    {
        return 'post';
    }

    protected function getBlade(): string|null
    {
        return null;
    }

    protected function getOtherButtonLabel(): string|null
    {
        return null;
    }

    protected function getOtherButtonRoute(): string|null
    {
        return null;
    }

    protected function getSubmitButtonType(): string
    {
        return Page::NORMAL_BUTTON;
    }

    // Summary
    public function summary(string $mode): Page
    {
        $subject = $this->getSubjectFromSession();

        return GovukPage::summary(
            $this->summaryTitle($subject),
            $subject->toSummary(),
            $this->summarySubmitLabel(),
            $this->summaryRoute($mode),
            $mode === self::EDIT
                ? $this->exitRoute()
                : $this->questionRoute(self::NEW, $this->getLastQuestionKey()),
            'post',
            $this->summaryBlade(),
            $this->summaryCancelLabel(),
            $this->summaryCancelRoute(),
        );
    }

    public function submit(string $mode): RedirectResponse
    {
        $subject = $this->getSubjectFromSession();
        $this->submitForm($subject, $mode);

        GovukForm::clear($this::key());

        return redirect($this->confirmationRoute($mode, $subject->id));
    }

    protected function summaryTitle(Model $subject): string
    {
        return 'Review your answers';
    }

    protected function summarySubmitLabel(): string
    {
        return 'Submit';
    }

    protected function summaryBlade(): string|null
    {
        return null;
    }

    protected function summaryCancelLabel(): string|null
    {
        return 'Cancel and exit';
    }

    protected function summaryCancelRoute(): string|null
    {
        return $this->exitRoute();
    }

    // Confirmation
    public function confirmation(string $mode, int|string $subjectKey): Page
    {
        $subject = $this->loadSubjectFromDatabase($subjectKey);

        return GovukPage::confirmation(
            $this->confirmationTitle($subject),
            $this->confirmationBlade(),
            $this->exitRoute(),
        )
            ->with('mode', $mode)
            ->with('subject', $subject);
    }

    protected function confirmationTitle(Model $subject): string
    {
        return 'Application complete';
    }

    // Subject
    protected function loadSubjectFromDatabase(int|string $subjectKey): Model
    {
        return $this->makeNewSubject()::findOrFail($subjectKey);
    }

    protected function getSubjectFromSession(): Model
    {
        return GovukForm::get(static::key());
    }

    // Questions
    protected function getQuestion(string $questionKey): Question
    {
        foreach (static::questions() as $question) {
            if ($question::key() === $questionKey) {
                return new $question();
            }
        }

        throw new QuestionNotFoundException("$questionKey does not exist in the {$this->key} form");
    }

    protected function getFirstQuestionKey(): string
    {
        return static::questions()[0]::key();
    }

    protected function getLastQuestionKey(): string
    {
        $finalIndex = array_key_last(static::questions());
        return static::questions()[$finalIndex]::key();
    }

    protected function getNextQuestionKey(string $questionKey): string|false
    {
        $index = $this->getQuestionIndex($questionKey);

        if ($index === false) {
            return false;
        }

        if (array_key_exists($index + 1, static::questions()) === true) {
            return static::questions()[$index + 1]::key();
        }

        return false;
    }

    protected function getPreviousQuestionKey(string $questionKey): string|false
    {
        $index = $this->getQuestionIndex($questionKey);

        if ($index === false) {
            return false;
        }

        if (array_key_exists($index - 1, static::questions()) === true) {
            return static::questions()[$index - 1]::key();
        }

        return false;
    }

    protected function isFirstQuestion(string $questionKey): bool
    {
        return $this->getFirstQuestionKey() === $questionKey;
    }

    protected function isLastQuestion(string $questionKey): bool
    {
        return $this->getLastQuestionKey() === $questionKey;
    }

    protected function getQuestionIndex(string $questionKey): int|false
    {
        foreach (static::questions() as $index => $question) {
            if ($question::key() === $questionKey) {
                return $index;
            }
        }

        return false;
    }

    // Routing
    protected function startRoute(): string
    {
        return route('forms.start', static::key());
    }

    protected function getNextRoute(string $mode, string $questionKey = null): string
    {
        if ($mode === self::NEW) {
            return $this->isLastQuestion($questionKey) === true
                ? $this->summaryRoute($mode)
                : $this->questionRoute($mode, $this->getNextQuestionKey($questionKey));
        }

        return $this->summaryRoute($mode);
    }

    protected function getBackRoute(string $mode, string $questionKey = null): string
    {
        if ($mode === self::NEW) {
            return $this->isFirstQuestion($questionKey) === true
                ? $this->startRoute()
                : $this->questionRoute($mode, $this->getPreviousQuestionKey($questionKey));
        }

        return $this->summaryRoute($mode);
    }

    protected function questionRoute(string $mode, string $questionKey): string
    {
        return route('forms.question', [
            static::key(),
            $mode,
            $questionKey,
        ]);
    }

    protected function summaryRoute(string $mode): string
    {
        return route('forms.summary', [
            static::key(),
            $mode,
        ]);
    }

    protected function confirmationRoute(string $mode, int|string $subjectKey): string
    {
        return route('forms.confirmation', [
            static::key(),
            $mode,
            $subjectKey,
        ]);
    }

    protected function exitRoute(): string
    {
        return route('/');
    }
}
<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Exceptions\FormNotFoundException;
use AnthonyEdmonds\GovukLaravel\Exceptions\QuestionNotFoundException;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    public const USES_DATABASE = true;

    // Abstract
    abstract public static function key(): string;

    abstract public function checkAccess(): void;

    abstract public function questions(): array;

    abstract protected function makeNewSubject(): Model;

    abstract protected function submitForm(Model $subject, string $mode): void;

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
            ->setBack($this->startBackRoute());
    }

    public function startBlade(): string|false
    {
        return false;
    }

    public function create(): RedirectResponse
    {
        GovukForm::put(static::key(), $this->makeNewSubject());

        return redirect($this->questionRoute(self::NEW, $this->getFirstQuestionKey()));
    }

    public function edit(Model $subject): RedirectResponse
    {
        GovukForm::put(static::key(), $subject);

        return redirect($this->summaryRoute(self::EDIT));
    }

    protected function startTitle(): string
    {
        return 'Begin your application';
    }

    protected function startButtonLabel(): string
    {
        return 'Start';
    }

    protected function startBackRoute(): string|null
    {
        return $this->exitRoute();
    }

    // Question
    public function question(string $mode, string $questionKey): Page
    {
        $questionClass = $this->getQuestion($questionKey);
        $subject = $this->getSubjectFromSession();
        $question = $questionClass->getQuestion($subject);

        $page = is_array($question) === true
            ? GovukPage::questions(
                $questionClass->getTitle($subject),
                $question,
                $questionClass->getSubmitButtonLabel($mode, $this->isLastQuestion($questionKey)),
                $this->questionRoute($mode, $questionKey),
            )
            : GovukPage::question(
                $question,
                $questionClass->getSubmitButtonLabel($mode, $this->isLastQuestion($questionKey)),
                $this->questionRoute($mode, $questionKey),
                $this->getBackRoute($mode, $questionKey),
            );

        return $page
            ->setBack($this->getBackRoute($mode, $questionKey))
            ->setMethod($questionClass->getMethod())
            ->setContent($questionClass->getBlade())
            ->setOtherButtonLabel($questionClass->getOtherButtonLabel())
            ->setOtherButtonHref($questionClass->getOtherButtonRoute($this, $mode))
            ->setOtherButtonMethod($questionClass->getOtherButtonMethod())
            ->setSubmitButtonType($questionClass->getSubmitButtonType())
            ->with('mode', $mode)
            ->with('subject', $subject);
    }

    public function store(Request $request, string $mode, string $questionKey): RedirectResponse
    {
        $question = $this->getQuestion($questionKey);
        $subject = $this->getSubjectFromSession();

        $question->validate($request, $subject);
        $question->store($request, $subject, $mode);
        GovukForm::put(static::key(), $subject);

        return redirect($this->getNextRoute($mode, $questionKey));
    }

    public function skip(string $mode, string $questionKey): RedirectResponse
    {
        $question = $this->getQuestion($questionKey);
        $subject = $this->getSubjectFromSession();

        $question->skip($subject, $mode);
        GovukForm::put(static::key(), $subject);

        return redirect($this->getNextRoute($mode, $questionKey));
    }

    // Summary
    public function summary(string $mode): Page
    {
        $subject = $this->getSubjectFromSession();

        return GovukPage::summary(
            $this->summaryTitle($subject),
            $subject->toSummary(true), /* @phpstan-ignore-line */
            $this->summarySubmitLabel(),
            $this->summaryRoute($mode),
            $mode === self::EDIT
                ? $this->exitRoute($subject)
                : $this->questionRoute(self::NEW, $this->getLastQuestionKey()),
            'post',
            $this->summaryBlade(),
            $this->summaryCancelLabel(),
            $this->summaryCancelRoute($subject),
        )
            ->with('mode', $mode)
            ->with('subject', $subject);
    }

    public function submit(string $mode): RedirectResponse
    {
        $subject = $this->getSubjectFromSession();
        $this->submitForm($subject, $mode);

        static::USES_DATABASE === false
            ? GovukForm::flash($this::key(), $subject)
            : GovukForm::clear($this::key());

        if ($this->confirmationBlade() === false) {
            return redirect($this->exitRoute($subject));
        } elseif (static::USES_DATABASE === false) {
            return redirect($this->confirmationRoute($mode));
        } else {
            return redirect($this->confirmationRoute($mode, $subject->getRouteKey()));
        }
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

    protected function summaryCancelRoute(Model|null $subject = null): string|null
    {
        return $this->exitRoute($subject);
    }

    // Confirmation
    public function confirmation(string $mode, Model $subject): Page
    {
        return GovukPage::confirmation(
            $this->confirmationTitle($subject),
            $this->confirmationBlade(),
        )
            ->with('mode', $mode)
            ->with('subject', $subject);
    }

    public function confirmationBlade(): string|false
    {
        return false;
    }

    public function loadConfirmationSubject(string|null $subjectKey = null): Model
    {
        return static::USES_DATABASE === false
            ? $this->getSubjectFromSession()
            : $this->loadSubjectFromDatabase($subjectKey);
    }

    protected function confirmationTitle(Model $subject): string
    {
        return 'Application complete';
    }

    // Subject
    public function loadSubjectFromDatabase(int|string $subjectKey): Model
    {
        $subject = $this->makeNewSubject();

        return $subject->newQuery()
            ->where($subject->getRouteKeyName(), '=', $subjectKey)
            ->firstOrFail();
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

        throw new QuestionNotFoundException($questionKey.' does not exist in the '.static::key().' form');
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
    public function startRoute(): string
    {
        return route('forms.start', static::key());
    }

    public function exitRoute(Model|null $subject = null): string
    {
        return route('/');
    }

    public static function skipRoute(string $mode, string $questionKey): string
    {
        return route('forms.skip', [
            static::key(),
            $mode,
            $questionKey,
        ]);
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
            if ($this->isFirstQuestion($questionKey) === true) {
                return $this->startBlade() !== false
                    ? $this->startRoute()
                    : $this->exitRoute();
            }

            return $this->questionRoute($mode, $this->getPreviousQuestionKey($questionKey));
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

    protected function confirmationRoute(string $mode, int|string $subjectKey = null): string
    {
        return route('forms.confirmation', [
            static::key(),
            $mode,
            $subjectKey,
        ]);
    }
}

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
        $isInProgress = GovukForm::has(static::key()) === true;

        if ($isInProgress === true) {
            $mode = GovukForm::get(static::key())->exists === true
                ? self::EDIT
                : self::REVIEW;

        } else {
            $mode = self::NEW;
        }

        return GovukPage::start(
            $this->startTitle(),
            $this->startBlade(),
            [],
            $this->startRoute(),
            $this->startButtonLabel(),
            Page::POST_METHOD,
        )
            ->setBack($this->startBackRoute())
            ->with('isInProgress', $isInProgress)
            ->with('summaryRoute', $this->summaryRoute($mode));
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

    protected function startBackRoute(): ?string
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

        $withs = $questionClass->withs($subject);
        foreach ($withs as $key => $value) {
            $page->with($key, $value);
        }

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

        return redirect($this->getNextRoute($mode, $questionKey, $question::LOOPS));
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
        $canEdit = $this->canEdit($subject);

        return GovukPage::summary(
            $this->summaryTitle($subject),
            $subject->toSummary($canEdit), /* @phpstan-ignore-line */
            $canEdit === true
                ? $this->summarySubmitLabel()
                : $this->summaryCancelLabel(),
            $canEdit === true
                ? $this->submitRoute($mode)
                : $this->summaryCancelRoute($subject),
            $mode === self::EDIT
                ? $this->exitRoute($subject)
                : $this->questionRoute(self::NEW, $this->getLastQuestionKey()),
            $canEdit === true
                ? Page::POST_METHOD
                : Page::GET_METHOD,
            $this->summaryBlade(),
            $canEdit === true
                ? $this->summaryCancelLabel()
                : null,
            $canEdit === true
                ? $this->summaryCancelRoute($subject)
                : null,
        )
            ->with('mode', $mode)
            ->with('subject', $subject)
            ->with('draftButtonLabel', $canEdit === true ? $this->summaryDraftLabel() : null)
            ->with('draftButtonAction', $canEdit === true ? $this->draftRoute($mode) : null);
    }

    public function submit(string $mode): RedirectResponse
    {
        $subject = $this->getSubjectFromSession();
        /** @phpstan-ignore-next-line */
        $canSubmit = $subject->canSubmit();

        if ($canSubmit !== true) {
            return redirect($this->summaryRoute($mode))->withErrors([
                'content' => $canSubmit,
            ]);
        }

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

    public function draft(string $mode): RedirectResponse
    {
        $subject = $this->getSubjectFromSession();
        $this->submitDraft($subject, $mode);

        return redirect($this->exitRoute($subject));
    }

    protected function summaryTitle(Model $subject): string
    {
        return 'Review your answers';
    }

    protected function summarySubmitLabel(): string
    {
        return 'Submit';
    }

    protected function summaryBlade(): ?string
    {
        return null;
    }

    protected function summaryCancelLabel(): ?string
    {
        return 'Cancel and exit';
    }

    protected function summaryCancelRoute(?Model $subject = null): ?string
    {
        return $this->exitRoute($subject);
    }

    protected function submitDraft(Model $subject, string $mode): void
    {
        //
    }

    protected function summaryDraftLabel(): ?string
    {
        return null;
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

    public function loadConfirmationSubject(?string $subjectKey = null): Model
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

    protected function canEdit(Model $subject): bool
    {
        return true;
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

    public function exitRoute(?Model $subject = null): string
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

    protected function getNextRoute(string $mode, ?string $questionKey = null, bool $loops = false): string
    {
        if ($loops === true) {
            return $this->questionRoute($mode, $questionKey);
        }

        if ($mode === self::NEW) {
            return $this->isLastQuestion($questionKey) === true
                ? $this->summaryRoute($mode)
                : $this->questionRoute($mode, $this->getNextQuestionKey($questionKey));
        }

        return $this->summaryRoute($mode);
    }

    protected function getBackRoute(string $mode, ?string $questionKey = null): string
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

    protected function submitRoute(string $mode): string
    {
        return route('forms.submit', [
            static::key(),
            $mode,
        ]);
    }

    protected function draftRoute(string $mode): string
    {
        return route('forms.draft', [
            static::key(),
            $mode,
        ]);
    }

    protected function confirmationRoute(string $mode, int|string|null $subjectKey = null): string
    {
        return route('forms.confirmation', [
            static::key(),
            $mode,
            $subjectKey,
        ]);
    }
}

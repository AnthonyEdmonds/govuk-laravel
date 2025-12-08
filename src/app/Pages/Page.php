<?php

namespace AnthonyEdmonds\GovukLaravel\Pages;

use Illuminate\Contracts\View\View;

class Page implements View
{
    public const array BUTTON_MODES = [
        self::NORMAL_BUTTON,
        self::SECONDARY_BUTTON,
        self::START_BUTTON,
        self::WARNING_BUTTON,
    ];

    public const string NORMAL_BUTTON = '';

    public const string SECONDARY_BUTTON = 'secondary';

    public const string START_BUTTON = 'start';

    public const string WARNING_BUTTON = 'warning';

    public const string OTHER_BUTTON_LABEL = 'Cancel and back';

    public const array BUTTON_METHODS = [
        self::GET_METHOD,
        self::POST_METHOD,
    ];

    public const array FORM_METHODS = [
        self::DELETE_METHOD,
        self::GET_METHOD,
        self::PATCH_METHOD,
        self::POST_METHOD,
        self::PUT_METHOD,
    ];

    public const string DELETE_METHOD = 'DELETE';

    public const string GET_METHOD = 'GET';

    public const string PATCH_METHOD = 'PATCH';

    public const string POST_METHOD = 'POST';

    public const string PUT_METHOD = 'PUT';

    protected ?string $action = null;

    protected ?string $back = null;

    protected ?array $breadcrumbs = null;

    protected ?string $currentSection = null;

    protected ?string $submitButtonLabel = null;

    protected string $submitButtonMode = self::NORMAL_BUTTON;

    protected ?string $otherButtonHref = null;

    protected ?string $otherButtonLabel = self::OTHER_BUTTON_LABEL;

    protected ?string $otherButtonMethod = self::GET_METHOD;

    protected ?string $caption = null;

    protected ?string $content = null;

    protected ?string $method = null;

    protected ?array $questions = null;

    protected ?array $summary = null;

    protected string $template = 'custom';

    protected string $title;

    protected bool $hideTitle = false;

    protected array $withs = [];

    // Setup
    public function __construct(string $title)
    {
        $this->setTitle($title);
    }

    public static function create(string $title): self
    {
        return new self($title);
    }

    // Setters
    public function addBreadcrumb(string $label, string $route): self
    {
        $this->back = null;
        $this->breadcrumbs[$label] = $route;

        return $this;
    }

    public function hideTitle(): self
    {
        $this->hideTitle = true;

        return $this;
    }

    public function setAction(?string $route = null): self
    {
        $this->action = $route;

        return $this;
    }

    public function setBack(?string $route = null): self
    {
        $this->back = $route;
        $this->breadcrumbs = null;

        return $this;
    }

    public function setBreadcrumbs(array $breadcrumbs = []): self
    {
        foreach ($breadcrumbs as $label => $route) {
            $this->addBreadcrumb($label, $route);
        }

        return $this;
    }

    public function setCurrentSection(string $section): self
    {
        $this->currentSection = $section;
        return $this;
    }

    public function setSubmitButtonLabel(?string $label = null): self
    {
        $this->submitButtonLabel = $label;

        return $this;
    }

    public function setSubmitButtonMode(string $type): self
    {
        $this->submitButtonMode = in_array($type, self::BUTTON_MODES, true) === true
            ? $type
            : self::NORMAL_BUTTON;

        return $this;
    }

    public function setOtherButtonHref(?string $href = null): self
    {
        $this->otherButtonHref = $href;

        return $this;
    }

    public function setOtherButtonLabel(?string $label = null): self
    {
        $this->otherButtonLabel = $label;

        return $this;
    }

    public function setOtherButtonMethod(string $method): self
    {
        $this->otherButtonMethod = in_array($method, self::BUTTON_METHODS) === true
            ? $method
            : self::GET_METHOD;

        return $this;
    }

    public function setCaption(?string $caption = null): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function setContent(?string $blade = null): self
    {
        $this->content = $blade;

        return $this;
    }

    public function setMethod(?string $method = null): self
    {
        $this->method = in_array($method, self::FORM_METHODS) === true
            ? $method
            : self::POST_METHOD;

        return $this;
    }

    public function setQuestions(?array $questions = null): self
    {
        $this->questions = $questions;

        return $this;
    }

    public function setSummary(?array $summary = null): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function showTitle(): self
    {
        $this->hideTitle = false;

        return $this;
    }

    // Getters
    public function toArray(): array
    {
        return [
            'action' => $this->action,
            'back' => $this->back,
            'breadcrumbs' => $this->breadcrumbs,
            'caption' => $this->caption,
            'content' => $this->content,
            'currentSection' => $this->currentSection,
            'hideTitle' => $this->hideTitle,
            'method' => $this->method,
            'otherButtonHref' => $this->otherButtonHref,
            'otherButtonLabel' => $this->otherButtonLabel,
            'otherButtonMethod' => $this->otherButtonMethod,
            'questions' => $this->questions,
            'submitButtonLabel' => $this->submitButtonLabel,
            'submitButtonMode' => $this->submitButtonMode,
            'summary' => $this->summary,
            'template' => $this->template,
            'title' => $this->title,
        ];
    }

    // View Contract
    public function render(): string
    {
        return view(
            "govuk::templates.$this->template",
            $this->toArray(),
            $this->withs,
        )
            ->render();
    }

    public function name(): string
    {
        return $this->content ?? $this->template;
    }

    public function with($key, $value = null): self
    {
        if (is_array($key) === true) {
            $this->withs = array_merge($this->withs, $key);
        } else {
            $this->withs[$key] = $value;
        }

        return $this;
    }

    public function getData(): array
    {
        return array_merge($this->toArray(), $this->withs);
    }
}

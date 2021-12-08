<?php

namespace AnthonyEdmonds\GovukLaravel\Pages;

use AnthonyEdmonds\GovukLaravel\Questions\Question;
use Illuminate\Contracts\View\View;

class Page
{
    public const BUTTON_TYPES = [
        self::NORMAL_BUTTON,
        self::SECONDARY_BUTTON,
        self::START_BUTTON,
        self::WARNING_BUTTON,
    ];
    public const NORMAL_BUTTON = '';
    public const SECONDARY_BUTTON = 'secondary';
    public const START_BUTTON = 'start';
    public const WARNING_BUTTON = 'warning';

    protected ?string $action = null;
    protected ?string $back = null;
    protected ?array $breadcrumbs = null;
    protected ?string $buttonLabel = null;
    protected string $buttonType = self::NORMAL_BUTTON;
    protected ?string $caption = null;
    protected ?string $content = null;
    protected ?string $method = null;
    protected ?array $questions = null;
    protected string $template = 'custom';
    protected string $title = 'Section title or question';
    protected bool $hideTitle = false;

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

    public function setAction(string $route = null): self
    {
        $this->action = $route;
        return $this;
    }

    public function setBack(string $route = null): self
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

    public function setButtonLabel(string $label = null): self
    {
        $this->buttonLabel = $label;
        return $this;
    }

    public function setButtonType(string $type): self
    {
        $this->buttonType = in_array($type, self::BUTTON_TYPES, true) === true
            ? $type
            : self::NORMAL_BUTTON;

        return $this;
    }

    public function setCaption(string $caption = null): self
    {
        $this->caption = $caption;
        return $this;
    }

    public function setContent(string $blade = null): self
    {
        $this->content = $blade;
        return $this;
    }

    public function setMethod(string $method = null): self
    {
        $this->method = $method;
        return $this;
    }

    public function setQuestion(Question $question = null): self
    {
        $this->questions = [$question];
        return $this;
    }

    public function setQuestions(array $questions = null): self
    {
        $this->questions = $questions;
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
            'buttonLabel' => $this->buttonLabel,
            'buttonType' => $this->buttonType,
            'caption' => $this->caption,
            'content' => $this->content,
            'hideTitle' => $this->hideTitle,
            'method' => $this->method,
            'questions' => $this->questions,
            'template' => $this->template,
            'title' => $this->title,
        ];
    }

    public function toView(): View
    {
        return view("govuk::templates.{$this->template}", $this->toArray());
    }
}

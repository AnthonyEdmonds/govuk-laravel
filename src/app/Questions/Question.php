<?php

namespace AnthonyEdmonds\GovukLaravel\Questions;

use ErrorException;
use Illuminate\View\ComponentAttributeBag;

class Question
{
    public const CHECKBOXES = 'checkboxes';
    public const HIDDEN = 'hidden-input';
    public const RADIOS = 'radios';
    public const SELECT = 'select';
    public const TEXT_AREA = 'textarea';
    public const TEXT_INPUT = 'text-input';
    public const QUESTION_FORMATS = [
        self::CHECKBOXES,
        self::HIDDEN,
        self::RADIOS,
        self::SELECT,
        self::TEXT_AREA,
        self::TEXT_INPUT
    ];

    public string $autocomplete = 'on';
    public ?int $count = null;
    public ?string $hint = null;
    public string $id;
    public bool $isInline = false;
    public string $inputmode = 'text';
    public bool $isTitle = false;
    public string $label;
    public string $labelSize = 's';
    public string $name;
    public array $options = [];
    public ?string $placeholder = null;
    public ?string $prefix = null;
    public int $rows = 5;
    public bool $spellcheck = false;
    public ?string $suffix = null;
    public ?int $threshold = null;
    public string $type = 'text';
    public mixed $value = null;
    public ?int $width = null;
    public ?int $words = null;

    protected string $format;

    // Setup
    public function __construct(
        string $label,
        string $name,
        string $format,
        string $id = null
    ) {
        if (in_array($format, self::QUESTION_FORMATS) === false) {
            throw new ErrorException("$format is not a valid GOV.UK Question type");
        }

        $this->label = $label;
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->format = $format;
    }

    public static function create(string $label, string $name, string $format, string $id = null): self
    {
        return new self($label, $name, $format, $id);
    }

    // Setters
    public function autocomplete(string $autocomplete = 'on'): self
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }

    public function count(int $count = null): self
    {
        $this->count = $count;
        return $this;
    }

    public function fromArray(array $settings): self
    {
        foreach ($settings as $property => $value) {
            $this->$property = $value;
        }

        return $this;
    }

    public function hint(string $hint): self
    {
        $this->hint = $hint;
        return $this;
    }

    public function inputmode(string $mode): self
    {
        $this->inputmode = $mode;
        return $this;
    }

    public function isInline(): self
    {
        $this->isInline = true;
        return $this;
    }

    public function isTitle(): self
    {
        $this->isTitle = true;
        return $this;
    }

    public function label(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function labelSize(string $size): self
    {
        $this->labelSize = $size;
        return $this;
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function options(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function prefix(string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function rows(int $rows): self
    {
        $this->rows = $rows;
        return $this;
    }

    public function spellcheck(bool $enabled): self
    {
        $this->spellcheck = $enabled;
        return $this;
    }

    public function suffix(string $suffix): self
    {
        $this->suffix = $suffix;
        return $this;
    }

    public function threshold(int $percent): self
    {
        if ($percent <= 0) {
            $percent = 0;
        }

        if ($percent >= 100) {
            $percent = 100;
        }

        $this->threshold = $percent;
        return $this;
    }

    public function type(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function value(mixed $value = null): self
    {
        $this->value = $value;
        return $this;
    }

    public function width(int $width): self
    {
        $this->width = $width;
        return $this;
    }

    public function words(int $words): self
    {
        $this->words = $words;
        return $this;
    }

    // Getters
    public function toArray(): array
    {
        return [
            'autocomplete' => $this->autocomplete,
            'count' => $this->count,
            'format' => $this->format,
            'hint' => $this->hint,
            'id' => $this->id,
            'inputmode' => $this->inputmode,
            'isInline' => $this->isInline,
            'isTitle' => $this->isTitle,
            'label' => $this->label,
            'labelSize' => $this->labelSize,
            'name' => $this->name,
            'options' => $this->options,
            'placeholder' => $this->placeholder,
            'prefix' => $this->prefix,
            'rows' => $this->rows,
            'spellcheck' => $this->spellcheck,
            'suffix' => $this->suffix,
            'threshold' => $this->threshold,
            'type' => $this->type,
            'value' => $this->value,
            'width' => $this->width,
            'words' => $this->words,
        ];
    }

    public function toBlade(): string
    {
        return view("govuk::components.{$this->format}", $this->toArray())
            ->with('attributes', new ComponentAttributeBag())
            ->render();
    }
}

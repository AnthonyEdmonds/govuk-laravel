<?php

namespace AnthonyEdmonds\GovukLaravel\Questions;

use ErrorException;
use Illuminate\View\ComponentAttributeBag;

class Question
{
    const HIDDEN = 'hidden-input';
    const RADIOS = 'radios-input';
    const SELECT = 'select-input';
    const TEXT_AREA = 'text-area-input';
    const TEXT_INPUT = 'text-input';
    const QUESTION_FORMATS = [
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
    public int $rows = 5;
    public bool $spellcheck = false;
    public ?int $threshold = null;
    public string $type = 'text';
    public ?string $value = null;
    public ?int $width = null;
    public ?int $words = null;

    protected string $format;

    // Setup
    public function __construct(
        string $label,
        string $name,
        string $format,
        string $id = null
    )
    {
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

    public function hint(string $hint): self
    {
        $this->hint = $hint;
        return $this;
    }

    public function inputMode(string $mode): self
    {
        $this->inputMode = $mode;
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

    public function labelSize(string $size): self
    {
        $this->labelSize = $size;
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

    public function value(string $value = null): self
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
            'rows' => $this->rows,
            'spellcheck' => $this->spellcheck,
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

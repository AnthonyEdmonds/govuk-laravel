<?php

namespace AnthonyEdmonds\GovukLaravel\Components;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Question extends Component
{
    public function __construct(
        public ?string $blade = null,
        public array|Arrayable $settings = [],
    ) {
        if ($this->settings instanceof Arrayable === true) {
            $this->settings = $this->settings->toArray();
        }

        if (array_key_exists('type', $this->settings) === false) {
            $this->settings['type'] = 'text-input';
        }

        if ($this->blade === null) {
            $this->blade = isset($this->settings['blade']) === true
                ? $this->settings['blade']
                : match ($this->settings['type'] ?? 'text-input') {
                    'checkbox',
                    'checkboxes' => 'checkboxes',
                    'date' => 'date-input',
                    'file',
                    'file-upload' => 'file-upload',
                    'hidden',
                    'hidden-input' => 'hidden-input',
                    'password' => 'password',
                    'radio',
                    'radios' => 'radios',
                    'select' => 'select',
                    'textarea' => 'textarea',
                    'time',
                    'time-input' => 'time-input',
                    default => 'text-input',
                };
        }
    }

    public function render(): View
    {
        return view("govuk::components.$this->blade", $this->settings);
    }
}

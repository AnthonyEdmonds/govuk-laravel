<?php

namespace AnthonyEdmonds\GovukLaravel\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Question extends Component
{
    public function __construct(
        public string $type = 'text-input',
        public array $settings = [],
    ) {
        if (isset($this->settings['type']) === true) {
            $this->type = $this->settings['type'];
        }
    }

    public function render(): View
    {
        return view("govuk::components.$this->type", $this->settings);
    }
}

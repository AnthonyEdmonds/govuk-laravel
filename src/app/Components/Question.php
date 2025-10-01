<?php

namespace AnthonyEdmonds\GovukLaravel\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Question extends Component
{
    public function __construct(
        public string $blade = 'text-input',
        public array $settings = [],
    ) {
        if (isset($this->settings['blade']) === true) {
            $this->blade = $this->settings['blade'];
        }
    }

    public function render(): View
    {
        return view("govuk::components.$this->blade", $this->settings);
    }
}

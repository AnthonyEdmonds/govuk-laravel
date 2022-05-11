<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use Illuminate\Http\RedirectResponse;

abstract class FormSection
{
    const KEY = 'form-section';
    const STEPS = [];

    protected Form $form;

    // Construction
    public function __construct(Form $form)
    {
        $this->form = $form;
    }
}

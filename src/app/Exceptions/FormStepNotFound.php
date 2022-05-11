<?php

namespace AnthonyEdmonds\GovukLaravel\Exceptions;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Forms\FormSection;
use ErrorException;

class FormStepNotFound extends ErrorException
{
    public function __construct(Form $form, FormSection $formSection, string $step)
    {
        parent::__construct(
            "$step was not found in section " .
            $formSection::KEY .
            ' of form ' .
            $form::KEY
        );
    }
}

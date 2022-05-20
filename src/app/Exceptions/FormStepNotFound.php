<?php

namespace AnthonyEdmonds\GovukLaravel\Exceptions;

use ErrorException;

class FormStepNotFound extends ErrorException
{
    public function __construct(string $formKey, string $stepKey)
    {
        parent::__construct("\"$stepKey\" is not part of the \"$formKey\" form");
    }
}

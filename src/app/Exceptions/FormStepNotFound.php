<?php

namespace AnthonyEdmonds\GovukLaravel\Exceptions;

use ErrorException;

class FormStepNotFound extends ErrorException
{
    public function __construct(string $step)
    {
        parent::__construct("$step was not found");
    }
}

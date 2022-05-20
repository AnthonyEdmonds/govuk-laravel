<?php

namespace AnthonyEdmonds\GovukLaravel\Exceptions;

use ErrorException;

class FormSectionNotFound extends ErrorException
{
    public function __construct(string $formKey, string $sectionKey)
    {
        parent::__construct("\"$sectionKey\" is not part of the \"$formKey\" form");
    }
}

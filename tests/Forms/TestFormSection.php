<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms;

use AnthonyEdmonds\GovukLaravel\Forms\FormSection;

class TestFormSection extends FormSection
{
    const STEPS = [
        TestFormStep::class,
        TestFormStep::class,
    ];
}

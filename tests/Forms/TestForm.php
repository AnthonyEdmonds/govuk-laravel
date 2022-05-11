<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms;

use AnthonyEdmonds\GovukLaravel\Forms\Form;

class TestForm extends Form
{
    const SECTIONS = [
        TestFormSection::class,
        TestFormSection::class,
    ];
}

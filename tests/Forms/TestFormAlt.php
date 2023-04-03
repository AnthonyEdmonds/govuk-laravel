<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms;

class TestFormAlt extends TestForm
{
    public static function key(): string
    {
        return 'test-form-alt';
    }

    public function startBlade(): string|false
    {
        return false;
    }

    public function confirmationBlade(): string|false
    {
        return false;
    }
}

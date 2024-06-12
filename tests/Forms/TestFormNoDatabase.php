<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms;

class TestFormNoDatabase extends TestForm
{
    public const bool USES_DATABASE = false;

    public static function key(): string
    {
        return 'test-form-no-database';
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukForm;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Session;

class HasTest extends TestCase
{
    public function testTrueWhenInSession(): void
    {
        Session::put('spoon', true);

        $this->assertTrue(
            GovukForm::has('spoon')
        );
    }

    public function testFalseWhenNotInSession(): void
    {
        $this->assertFalse(
            GovukForm::has('spoon')
        );
    }
}

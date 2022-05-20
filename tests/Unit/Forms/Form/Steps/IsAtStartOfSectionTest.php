<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form\Steps;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class IsAtStartOfSectionTest
    extends TestCase
{
    public function testTrueWhenAtStartOfSection(): void
    {
        $this->assertTrue(
            TestForm::isAtStartOfSection('inside-section')
        );
    }

    public function testTrueWhenAfterSection(): void
    {
        $this->assertTrue(
            TestForm::isAtStartOfSection('after-section')
        );
    }

    public function testTrueWhenFirstStep(): void
    {
        $this->assertTrue(
            TestForm::isAtStartOfSection('before-section')
        );
    }

    public function testFalseWhenLastSectionStep(): void
    {
        $this->assertFalse(
            TestForm::isAtStartOfSection('other-inside')
        );
    }

    public function testFalseWhenLastStep(): void
    {
        $this->assertFalse(
            TestForm::isAtStartOfSection('outside-section')
        );
    }

    public function testFalseWhenMidSection(): void
    {
        $this->assertFalse(
            TestForm::isAtStartOfSection('mid-section')
        );
    }
}

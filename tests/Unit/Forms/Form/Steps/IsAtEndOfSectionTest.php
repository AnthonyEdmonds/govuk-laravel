<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form\Steps;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class IsAtEndOfSectionTest extends TestCase
{
    public function testTrueWhenAtEndOfSection(): void
    {
        $this->assertTrue(
            TestForm::isAtEndOfSection('other-inside')
        );
    }

    public function testTrueWhenBeforeSection(): void
    {
        $this->assertTrue(
            TestForm::isAtEndOfSection('before-section')
        );
    }

    public function testTrueWhenLastStep(): void
    {
        $this->assertTrue(
            TestForm::isAtEndOfSection('outside-section')
        );
    }

    public function testFalseWhenFirstSectionStep(): void
    {
        $this->assertFalse(
            TestForm::isAtEndOfSection('inside-section')
        );
    }

    public function testFalseWhenFirstStep(): void
    {
        $this->assertFalse(
            TestForm::isAtEndOfSection('after-section')
        );
    }

    public function testFalseWhenMidSection(): void
    {
        $this->assertFalse(
            TestForm::isAtEndOfSection('mid-section')
        );
    }
}

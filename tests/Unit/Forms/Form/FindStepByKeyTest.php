<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormStepQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormStepQuestions;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class FindStepByKeyTest extends TestCase
{
    // Match Search Mode
    public function testReturnsStepOutsideSection(): void
    {
        $this->assertEquals(
            ['outside-section' => TestFormStepQuestions::class],
            TestForm::findStepByKey('outside-section')
        );
    }

    public function testReturnsStepInsideSection(): void
    {
        $this->assertEquals(
            ['inside-section' => TestFormStepQuestion::class],
            TestForm::findStepByKey('inside-section')
        );
    }

    public function testReturnsFalseWhenMissingStep(): void
    {
        $this->assertFalse(
            TestForm::findStepByKey('does-not-exist')
        );
    }

    // Next Search Mode
    public function testReturnsNextClassInSectionWhenInsideSection(): void
    {
        $this->assertEquals(
            ['other-inside' => TestFormStepQuestions::class],
            TestForm::findStepByKey('inside-section',   true)
        );
    }

    public function testReturnsNextClassOutsideSectionWhenOutsideSection(): void
    {
        $this->assertEquals(
            ['outside-section' => TestFormStepQuestions::class],
            TestForm::findStepByKey('after-section',   true)
        );
    }

    public function testReturnsNextClassOutsideSectionWhenInsideSection(): void
    {
        $this->assertEquals(
            ['after-section' => TestFormStepQuestion::class],
            TestForm::findStepByKey('other-inside',   true)
        );
    }

    public function testReturnsNextClassInsideSectionWhenOutsideSection(): void
    {
        $this->assertEquals(
            ['inside-section' => TestFormStepQuestion::class],
            TestForm::findStepByKey('before-section',   true)
        );
    }

    public function testReturnsFalseWhenNoMoreSteps(): void
    {
        $this->assertFalse(
            TestForm::findStepByKey('outside-section',   true)
        );
    }

    // Previous Search Mode
    public function testReturnsPreviousClassInSectionWhenInsideSection(): void
    {
        $this->assertEquals(
            ['inside-section' => TestFormStepQuestion::class],
            TestForm::findStepByKey('other-inside',   false)
        );
    }

    public function testReturnsPreviousClassOutsideSectionWhenOutsideSection(): void
    {
        $this->assertEquals(
            ['after-section' => TestFormStepQuestion::class],
            TestForm::findStepByKey('outside-section',   false)
        );
    }

    public function testReturnsPreviousClassOutsideSectionWhenInsideSection(): void
    {
        $this->assertEquals(
            ['before-section' => TestFormStepQuestions::class],
            TestForm::findStepByKey('inside-section',   false)
        );
    }

    public function testReturnsPreviousClassInsideSectionWhenOutsideSection(): void
    {
        $this->assertEquals(
            ['other-inside' => TestFormStepQuestions::class],
            TestForm::findStepByKey('after-section',   false)
        );
    }

    public function testReturnsFalseWhenAtStart(): void
    {
        $this->assertFalse(
            TestForm::findStepByKey('before-section',   false)
        );
    }
}

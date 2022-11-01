<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Questions\Question;

use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ToBladeTest extends TestCase
{
    protected Question $question;

    protected string $blade;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setViewErrors();
        $this->question = new Question('Duck', 'Dave', Question::CHECKBOXES);
        $this->blade = $this->question->toBlade();
    }

    public function testGetsFormat(): void
    {
        $this->assertStringContainsString('govuk-checkboxes', $this->blade);
    }

    public function testGetsAttributes(): void
    {
        $this->assertStringContainsString('Duck', $this->blade);
        $this->assertStringContainsString('Dave', $this->blade);
    }
}
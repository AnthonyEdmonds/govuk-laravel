<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Words;

use AnthonyEdmonds\GovukLaravel\Rules\Words\MaxWords;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class MaxWordsTest extends TestCase
{
    protected MaxWords $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new MaxWords(3);
    }

    public function testTrueWhenAtLimit(): void
    {
        $this->assertRulePasses($this->rule, 'name', 'These three words');
    }

    public function testTrueWhenOnNewLines(): void
    {
        $this->assertRulePasses($this->rule, 'name', "These\nthree\nwords");
    }

    public function testTrueWhenBelowLimit(): void
    {
        $this->assertRulePasses($this->rule, 'name', 'Two cool');
    }

    public function testFalseWhenAboveLimit(): void
    {
        $this->assertRuleFails($this->rule, 'name', 'Four is too many', ':Attribute must be 3 words or fewer.');
    }
}

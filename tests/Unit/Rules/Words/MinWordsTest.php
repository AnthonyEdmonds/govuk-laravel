<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Words;

use AnthonyEdmonds\GovukLaravel\Rules\Words\MinWords;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class MinWordsTest extends TestCase
{
    protected MinWords $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new MinWords(3);
    }

    public function testTrueWhenAtLimit(): void
    {
        $this->assertRulePasses($this->rule, 'name', 'These three words');
    }

    public function testTrueWhenAboveLimit(): void
    {
        $this->assertRulePasses($this->rule, 'name', 'Four or more words');
    }

    public function testFalseWhenBelowLimit(): void
    {
        $this->assertRuleFails($this->rule, 'name', 'Two few', ':attribute must be 3 words or more.');
    }
}

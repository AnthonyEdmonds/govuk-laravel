<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Words;

use AnthonyEdmonds\GovukLaravel\Rules\Words\WordsBetween;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class WordsBetweenTest extends TestCase
{
    protected WordsBetween $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new WordsBetween(3, 6);
    }

    public function testFalseWhenAboveLimit(): void
    {
        $this->assertRuleFails($this->rule, 'name', 'Seven is just out of the question', ':attribute must be between 3 and 6 words.');
    }

    public function testTrueWhenAtMaxLimit(): void
    {
        $this->assertRulePasses($this->rule, 'name', 'Six is just enough for me');
    }

    public function testTrueWhenOnNewLines(): void
    {
        $this->assertRulePasses($this->rule, 'name', "These\nfive\nwords\nare\nhere");
    }

    public function testTrueWhenBetweenLimit(): void
    {
        $this->assertRulePasses($this->rule, 'name', 'Five words sits quite nicely');
    }

    public function testTrueWhenAtMinLimit(): void
    {
        $this->assertRulePasses($this->rule, 'name', 'Three smol words');
    }

    public function testFalseWhenBelowLimit(): void
    {
        $this->assertRuleFails($this->rule, 'name', 'Two low', ':attribute must be between 3 and 6 words.');
    }
}

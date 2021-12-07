<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\MinWords;

use AnthonyEdmonds\GovukLaravel\Rules\MinWords;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestView;

class PassesTest extends TestCase
{
    protected MinWords $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new MinWords(3);
    }

    public function testTrueWhenAtLimit(): void
    {
        $this->assertTrue(
            $this->rule->passes('name', 'These three words')
        );
    }

    public function testTrueWhenAboveLimit(): void
    {
        $this->assertTrue(
            $this->rule->passes('name', 'Four or more words')
        );
    }

    public function testFalseWhenBelowLimit(): void
    {
        $this->assertFalse(
            $this->rule->passes('name', 'Two few')
        );
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\WordsBetween;

use AnthonyEdmonds\GovukLaravel\Rules\WordsBetween;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestView;

class PassesTest extends TestCase
{
    protected WordsBetween $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new WordsBetween(3, 6);
    }

    public function testFalseWhenAboveLimit(): void
    {
        $this->assertFalse(
            $this->rule->passes('name', 'Seven is just out of the question')
        );
    }

    public function testTrueWhenAtMaxLimit(): void
    {
        $this->assertTrue(
            $this->rule->passes('name', 'Six is just enough for me')
        );
    }

    public function testTrueWhenBetweenLimit(): void
    {
        $this->assertTrue(
            $this->rule->passes('name', 'Five words sits quite nicely')
        );
    }

    public function testTrueWhenAtMinLimit(): void
    {
        $this->assertTrue(
            $this->rule->passes('name', 'Three smol words')
        );
    }

    public function testFalseWhenBelowLimit(): void
    {
        $this->assertFalse(
            $this->rule->passes('name', 'Two low')
        );
    }
}

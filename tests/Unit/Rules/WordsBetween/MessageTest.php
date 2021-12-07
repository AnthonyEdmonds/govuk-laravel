<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\WordsBetween;

use AnthonyEdmonds\GovukLaravel\Rules\WordsBetween;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestView;

class MessageTest extends TestCase
{
    protected WordsBetween $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new WordsBetween(3, 5);
    }

    public function testMessageHasMin(): void
    {
        $this->assertEquals(
            ':attribute must be between 3 and 5 words.',
            $this->rule->message()
        );
    }
}

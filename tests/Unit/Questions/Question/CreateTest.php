<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Questions\Question;

use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class CreateTest extends TestCase
{
    public function testCreatesQuestion(): void
    {
        $this->assertInstanceOf(
            Question::class,
            Question::create('Duck', 'Jim', Question::FILE)
        );
    }
}

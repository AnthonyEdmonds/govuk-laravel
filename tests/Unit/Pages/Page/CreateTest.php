<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class CreateTest extends TestCase
{
    public function testCreatesNewInstance(): void
    {
        $this->assertInstanceOf(
            Page::class,
            Page::create('My title'),
        );
    }
}

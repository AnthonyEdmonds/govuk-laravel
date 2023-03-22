<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ConstructTest extends TestCase
{
    public function testSetsTitle(): void
    {
        $page = new Page('My title');

        $this->assertEquals(
            'My title',
            $page->toArray()['title'],
        );
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class WithTest extends TestCase
{
    public function testHandlesKeyValue(): void
    {
        $page = Page::create('My title');
        $page->with('potato', 'Cheesy peas');

        $this->assertEquals(
            'Cheesy peas',
            $page->getData()['potato'],
        );
    }

    public function testHandlesArray(): void
    {
        $page = Page::create('My title');
        $page->with([
            'potato' => 'Cheesy peas',
        ]);

        $this->assertEquals(
            'Cheesy peas',
            $page->getData()['potato'],
        );
    }
}

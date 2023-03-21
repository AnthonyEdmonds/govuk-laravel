<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetTitleTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setTitle('My other title');

        $this->assertEquals(
            'My other title',
            $page->toArray()['title'],
        );
    }
}

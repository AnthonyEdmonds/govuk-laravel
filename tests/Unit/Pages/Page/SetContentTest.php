<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetContentTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setContent('my.blade');

        $this->assertEquals(
            'my.blade',
            $page->toArray()['content'],
        );
    }
}

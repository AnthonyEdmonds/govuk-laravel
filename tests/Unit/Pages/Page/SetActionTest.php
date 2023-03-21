<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetActionTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setAction('my-action');

        $this->assertEquals(
            'my-action',
            $page->toArray()['action'],
        );
    }
}

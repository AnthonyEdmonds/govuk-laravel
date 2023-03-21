<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetOtherButtonMethodTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setOtherButtonMethod(Page::POST_METHOD);

        $this->assertEquals(
            Page::POST_METHOD,
            $page->toArray()['otherButtonMethod'],
        );
    }
}

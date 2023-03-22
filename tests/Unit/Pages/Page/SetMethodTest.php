<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetMethodTest extends TestCase
{
    public function testSetsMethod(): void
    {
        $page = Page::create('My title');
        $page->setMethod(Page::DELETE_METHOD);

        $this->assertEquals(
            Page::DELETE_METHOD,
            $page->toArray()['method'],
        );
    }
    
    public function testDefaultsToPost(): void
    {
        $page = Page::create('My title');
        $page->setMethod('my-method');

        $this->assertEquals(
            Page::POST_METHOD,
            $page->toArray()['method'],
        );
    }
}

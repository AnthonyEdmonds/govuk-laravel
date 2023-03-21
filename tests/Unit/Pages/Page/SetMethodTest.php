<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetMethodTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setMethod('my-method');

        $this->assertEquals(
            'my-method',
            $page->toArray()['method'],
        );
    }
}

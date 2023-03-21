<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetOtherButtonHrefTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setOtherButtonHref('my-route');

        $this->assertEquals(
            'my-route',
            $page->toArray()['otherButtonHref'],
        );
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetTemplateTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setTemplate('my-template');

        $this->assertEquals(
            'my-template',
            $page->toArray()['template'],
        );
    }
}

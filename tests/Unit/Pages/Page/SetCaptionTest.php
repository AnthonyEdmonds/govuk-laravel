<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetCaptionTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setCaption('My caption');

        $this->assertEquals(
            'My caption',
            $page->toArray()['caption'],
        );
    }
}

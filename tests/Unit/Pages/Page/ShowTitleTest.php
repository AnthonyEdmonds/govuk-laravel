<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ShowTitleTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->showTitle();

        $this->assertFalse(
            $page->toArray()['hideTitle'],
        );
    }
}

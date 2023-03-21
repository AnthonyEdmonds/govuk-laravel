<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class HideTitleTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->hideTitle();

        $this->assertTrue(
            $page->toArray()['hideTitle'],
        );
    }
}

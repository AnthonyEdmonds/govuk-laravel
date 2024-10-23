<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetCurrentSectionTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setCurrentSection('section');

        $this->assertEquals(
            'section',
            $page->toArray()['currentSection'],
        );
    }
}

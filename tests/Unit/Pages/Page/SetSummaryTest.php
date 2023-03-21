<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetSummaryTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setSummary([
            'My summary',
        ]);

        $this->assertEquals(
            [
                'My summary',
            ],
            $page->toArray()['summary'],
        );
    }
}

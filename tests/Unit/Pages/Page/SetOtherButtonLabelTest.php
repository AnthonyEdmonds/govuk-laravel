<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetOtherButtonLabelTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setOtherButtonLabel('My label');

        $this->assertEquals(
            'My label',
            $page->toArray()['otherButtonLabel'],
        );
    }
}

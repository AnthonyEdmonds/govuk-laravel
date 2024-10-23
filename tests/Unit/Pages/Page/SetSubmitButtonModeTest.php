<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetSubmitButtonModeTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setSubmitButtonMode(Page::SECONDARY_BUTTON);

        $this->assertEquals(
            Page::SECONDARY_BUTTON,
            $page->toArray()['submitButtonMode'],
        );
    }
}

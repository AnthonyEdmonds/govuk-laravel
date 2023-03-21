<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetSubmitButtonTypeTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setSubmitButtonType(Page::SECONDARY_BUTTON);

        $this->assertEquals(
            Page::SECONDARY_BUTTON,
            $page->toArray()['submitButtonType'],
        );
    }
}

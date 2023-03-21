<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetSubmitButtonLabelTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setSubmitButtonLabel('Submit label');

        $this->assertEquals(
            'Submit label',
            $page->toArray()['submitButtonLabel'],
        );
    }
}

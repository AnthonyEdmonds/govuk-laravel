<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetQuestionsTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setQuestions([
            1,
            2,
            3,
        ]);

        $this->assertEquals(
            [
                1,
                2,
                3,
            ],
            $page->toArray()['questions'],
        );
    }
}

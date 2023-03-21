<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetQuestionTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setQuestion(GovukQuestion::hidden('my-name', 'my-value'));

        $this->assertEquals(
            'my-name',
            $page->toArray()['questions'][0]->name,
        );
    }
}

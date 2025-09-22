<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class QuestionsTest extends TestCase
{
    protected array $page;

    public function test(): void
    {
        $this->makePage();

        $this->assertEquals(
            'It',
            $this->page['title'],
        );

        $this->assertEquals(
            ['is', 'always'],
            $this->page['questions'],
        );

        $this->assertEquals(
            'sunny',
            $this->page['submitButtonLabel'],
        );

        $this->assertEquals(
            'elsewhere',
            $this->page['action'],
        );

        $this->assertEquals(
            'dog',
            $this->page['back'],
        );

        $this->assertEquals(
            Page::POST_METHOD,
            $this->page['method'],
        );

        $this->assertEquals(
            'lizard',
            $this->page['content'],
        );

        $this->assertEquals(
            'bird',
            $this->page['otherButtonLabel'],
        );

        $this->assertEquals(
            'dragon',
            $this->page['otherButtonHref'],
        );

        $this->assertEquals(
            Page::START_BUTTON,
            $this->page['submitButtonMode'],
        );

        $this->assertEquals(
            'question',
            $this->page['template'],
        );
    }

    public function testOtherButtonLabelIsDefaultWhenNull(): void
    {
        $this->makePage(null);

        $this->assertEquals(
            Page::OTHER_BUTTON_LABEL,
            $this->page['otherButtonLabel'],
        );
    }

    protected function makePage(
        ?string $otherButtonLabel = 'bird',
    ): void {
        $this->page = GovukPage::questions(
            'It',
            ['is', 'always'],
            'sunny',
            'elsewhere',
            'dog',
            Page::POST_METHOD,
            'lizard',
            $otherButtonLabel,
            'dragon',
            Page::START_BUTTON,
        )->toArray();
    }
}

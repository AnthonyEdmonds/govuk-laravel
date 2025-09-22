<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class QuestionTest extends TestCase
{
    protected array $page;

    public function test(): void
    {
        $this->makePage();

        $this->assertEquals(
            [
                [
                    'label' => 'hello',
                    'isTitle' => true,
                    'labelSize' => 'l',
                ],
            ],
            $this->page['questions'],
        );

        $this->assertEquals(
            'for',
            $this->page['submitButtonLabel'],
        );

        $this->assertEquals(
            'toll',
            $this->page['action'],
        );

        $this->assertEquals(
            'cheese',
            $this->page['back'],
        );

        $this->assertEquals(
            Page::POST_METHOD,
            $this->page['method'],
        );

        $this->assertEquals(
            'dog',
            $this->page['content'],
        );

        $this->assertEquals(
            'bird',
            $this->page['otherButtonLabel'],
        );

        $this->assertEquals(
            'Lizard',
            $this->page['otherButtonHref'],
        );

        $this->assertEquals(
            Page::START_BUTTON,
            $this->page['submitButtonMode'],
        );

        $this->assertEquals(
            'hello',
            $this->page['title'],
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
        $this->page = GovukPage::question(
            ['label' => 'hello'],
            'for',
            'toll',
            'cheese',
            Page::POST_METHOD,
            'dog',
            $otherButtonLabel,
            'Lizard',
            Page::START_BUTTON,
        )->toArray();
    }
}

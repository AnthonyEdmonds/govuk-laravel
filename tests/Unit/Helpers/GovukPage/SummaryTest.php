<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SummaryTest extends TestCase
{
    protected array $page;

    public function testHasTitle(): void
    {
        $this->makePage();

        $this->assertEquals(
            'It',
            $this->page['title'],
        );
    }

    public function testHasSummary(): void
    {
        $this->makePage();

        $this->assertEquals(
            ['is', 'always'],
            $this->page['summary'],
        );
    }

    public function testHasSubmitButtonLabel(): void
    {
        $this->makePage();

        $this->assertEquals(
            'sunny',
            $this->page['submitButtonLabel'],
        );
    }

    public function testHasAction(): void
    {
        $this->makePage();

        $this->assertEquals(
            'elsewhere',
            $this->page['action'],
        );
    }

    public function testHasBack(): void
    {
        $this->makePage();

        $this->assertEquals(
            'dog',
            $this->page['back'],
        );
    }

    public function testHasMethod(): void
    {
        $this->makePage();

        $this->assertEquals(
            Page::POST_METHOD,
            $this->page['method'],
        );
    }

    public function testHasBlade(): void
    {
        $this->makePage();

        $this->assertEquals(
            'lizard',
            $this->page['content'],
        );
    }

    public function testHasOtherButtonLabel(): void
    {
        $this->makePage();

        $this->assertEquals(
            'bird',
            $this->page['otherButtonLabel'],
        );
    }

    public function testHasOtherButtonHref(): void
    {
        $this->makePage();

        $this->assertEquals(
            'dragon',
            $this->page['otherButtonHref'],
        );
    }

    public function testSubmitButtonType(): void
    {
        $this->makePage();

        $this->assertEquals(
            Page::START_BUTTON,
            $this->page['submitButtonType'],
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

    public function testSetTemplate(): void
    {
        $this->makePage();

        $this->assertEquals(
            'summary',
            $this->page['template'],
        );
    }

    protected function makePage(
        ?string $otherButtonLabel = 'bird',
    ): void {
        $this->page = GovukPage::summary(
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

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ConfirmTest extends TestCase
{
    protected array $page;

    public function testHasTitle(): void
    {
        $this->makePage();

        $this->assertEquals(
            'good',
            $this->page['title'],
        );
    }

    public function testHasBlade(): void
    {
        $this->makePage();

        $this->assertEquals(
            'for',
            $this->page['content'],
        );
    }

    public function testHasSubmitButtonLabel(): void
    {
        $this->makePage();

        $this->assertEquals(
            'apples',
            $this->page['submitButtonLabel'],
        );
    }

    public function testHasAction(): void
    {
        $this->makePage();

        $this->assertEquals(
            'table',
            $this->page['action'],
        );
    }

    public function testHasBack(): void
    {
        $this->makePage();

        $this->assertEquals(
            'let',
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

    public function testHasOtherButtonLabel(): void
    {
        $this->makePage();

        $this->assertEquals(
            'carrot',
            $this->page['otherButtonLabel'],
        );
    }

    public function testHasOtherButtonHref(): void
    {
        $this->makePage();

        $this->assertEquals(
            'kitten',
            $this->page['otherButtonHref'],
        );
    }

    public function testHasSubmitButtonType(): void
    {
        $this->makePage();

        $this->assertEquals(
            Page::WARNING_BUTTON,
            $this->page['submitButtonType'],
        );
    }

    public function testHasCaption(): void
    {
        $this->makePage();

        $this->assertEquals(
            'beagle',
            $this->page['caption'],
        );
    }

    public function testOtherButtonHrefIsBackWhenNull(): void
    {
        $this->makePage(null, null);

        $this->assertEquals(
            'let',
            $this->page['otherButtonHref'],
        );
    }

    public function testOtherButtonLabelIsDefaultWhenNull(): void
    {
        $this->makePage(null, null);

        $this->assertEquals(
            Page::OTHER_BUTTON_LABEL,
            $this->page['otherButtonLabel'],
        );
    }

    public function testSetTemplate(): void
    {
        $this->makePage();

        $this->assertEquals(
            'confirm',
            $this->page['template'],
        );
    }

    protected function makePage(
        string|null $otherButtonLabel = 'carrot',
        string|null $otherButtonHref = 'kitten',
    ): void {
        $this->page = GovukPage::confirm(
            'good',
            'for',
            'apples',
            'table',
            'let',
            Page::POST_METHOD,
            $otherButtonLabel,
            $otherButtonHref,
            Page::WARNING_BUTTON,
            'beagle',
        )->toArray();
    }
}

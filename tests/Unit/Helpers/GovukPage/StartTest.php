<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class StartTest extends TestCase
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

    public function testHasBlade(): void
    {
        $this->makePage();

        $this->assertEquals(
            'is',
            $this->page['content'],
        );
    }

    public function testHasBreadcrumbs(): void
    {
        $this->makePage();

        $this->assertEquals(
            ['always', 'sunny'],
            $this->page['breadcrumbs'],
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

    public function testHasButtonLabel(): void
    {
        $this->makePage();

        $this->assertEquals(
            'dog',
            $this->page['submitButtonLabel'],
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

    public function testSubmitButtonType(): void
    {
        $this->makePage();

        $this->assertEquals(
            Page::START_BUTTON,
            $this->page['submitButtonType'],
        );
    }

    public function testSetTemplate(): void
    {
        $this->makePage();

        $this->assertEquals(
            'start',
            $this->page['template'],
        );
    }

    protected function makePage(
        string|null $otherButtonLabel = 'bird',
    ): void {
        $this->page = GovukPage::start(
            'It',
            'is',
            ['always', 'sunny'],
            'elsewhere',
            'dog',
            Page::POST_METHOD,
        )->toArray();
    }
}

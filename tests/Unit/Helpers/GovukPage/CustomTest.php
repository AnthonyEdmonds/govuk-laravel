<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class CustomTest extends TestCase
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

    public function testHasBreadcrumbs(): void
    {
        $this->makePage();

        $this->assertEquals(
            ['white','brown'],
            $this->page['breadcrumbs'],
        );
    }

    public function testHasCaption(): void
    {
        $this->makePage();

        $this->assertEquals(
            'you',
            $this->page['caption'],
        );
    }

    public function testSetTemplate(): void
    {
        $this->makePage();

        $this->assertEquals(
            'custom',
            $this->page['template'],
        );
    }

    protected function makePage(): void
    {
        $this->page = GovukPage::custom(
            'good',
            'for',
            ['white','brown'],
            'you',
        )->toArray();
    }
};

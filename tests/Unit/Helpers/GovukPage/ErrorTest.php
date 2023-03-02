<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ErrorTest extends TestCase
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

    public function testHasBackUrl(): void
    {
        $this->makePage();

        $this->assertEquals(
            'http://localhost',
            $this->page['back'],
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

    public function testSetTemplate(): void
    {
        $this->makePage();

        $this->assertEquals(
            'error',
            $this->page['template'],
        );
    }

    protected function makePage(): void
    {
        $this->page = GovukPage::error(
            'good',
            'for',
        )->toArray();
    }
};

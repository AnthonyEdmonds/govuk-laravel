<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ConfirmationTest extends TestCase
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

    public function testHideTitleIsTrue(): void
    {
        $this->makePage();

        $this->assertTrue(
            $this->page['hideTitle'],
        );
    }

    public function testSetTemplate(): void
    {
        $this->makePage();

        $this->assertEquals(
            'confirmation',
            $this->page['template'],
        );
    }

    protected function makePage(): void
    {
        $this->page = GovukPage::confirmation(
            'good',
            'for',
        )->toArray();
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class InterruptionTest extends TestCase
{
    protected array $page;

    protected function setUp(): void
    {
        parent::setUp();

        $this->page = GovukPage::interruption(
            'My title',
            'Confirm label',
            'Confirm url',
            'Cancel label',
            'Cancel url',
            'Content blade',
            'Back url',
        )->getData();
    }

    public function test(): void
    {
        $this->assertEquals(
            'My title',
            $this->page['title'],
        );

        $this->assertEquals(
            'Back url',
            $this->page['back'],
        );

        $this->assertEquals(
            'Content blade',
            $this->page['content'],
        );

        $this->assertEquals(
            'interruption',
            $this->page['template'],
        );

        $this->assertEquals(
            'Confirm label',
            $this->page['confirmLabel'],
        );

        $this->assertEquals(
            'Confirm url',
            $this->page['confirmUrl'],
        );

        $this->assertEquals(
            'Cancel label',
            $this->page['cancelLabel'],
        );

        $this->assertEquals(
            'Cancel url',
            $this->page['cancelUrl'],
        );
    }
}

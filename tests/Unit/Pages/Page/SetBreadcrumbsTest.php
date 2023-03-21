<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetBreadcrumbsTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $page->setBreadcrumbs([
            'My label' => 'my-route',
        ]);

        $this->assertEquals(
            [
                'My label' => 'my-route',
            ],
            $page->toArray()['breadcrumbs'],
        );
    }
}

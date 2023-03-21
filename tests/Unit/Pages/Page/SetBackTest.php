<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SetBackTest extends TestCase
{
    protected Page $page;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->page = Page::create('My title');
    }

    public function testSetsBack(): void
    {
        $this->page->setBack('my-back');

        $this->assertEquals(
            'my-back',
            $this->page->toArray()['back'],
        );
    }
    
    public function testClearsBreadcrumbs(): void
    {
        $this->page->setBreadcrumbs([
            'Label' => 'route',
        ]);

        $this->page->setBack('my-back');

        $this->assertNull($this->page->toArray()['breadcrumbs']);
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class AddBreadcrumbTest extends TestCase
{
    protected Page $page;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->page = Page::create('My title');
    }

    public function testAddsBreadcrumb(): void
    {
        $this->page->addBreadcrumb('My label', 'my-route');
        
        $this->assertEquals(
            [
                'My label' => 'my-route',
            ],
            $this->page->toArray()['breadcrumbs'],
        );
    }
    
    public function testClearsBack(): void
    {
        $this->page->setBack('back-route');
        $this->page->addBreadcrumb('My label', 'my-route');
        
        $this->assertNull(
            $this->page->toArray()['back'],
        );
    }
}

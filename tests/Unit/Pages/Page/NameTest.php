<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class NameTest extends TestCase
{
    protected Page $page;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->page = Page::create('My title');
    }

    public function testContentWhenSet(): void
    {
        $this->page->setContent('my-content');

        $this->assertEquals(
            'my-content',
            $this->page->name(),
        );
    }
    
    public function testTemplateOtherwise(): void
    {
        $this->page->setTemplate('my-template');

        $this->assertEquals(
            'my-template',
            $this->page->name(),
        );
    }
}

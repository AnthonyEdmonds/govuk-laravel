<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetDataTest extends TestCase
{
    protected Page $page;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->page = Page::create('My title');
    }

    public function testHasData(): void
    {
        $this->assertArrayHasKey(
            'title',
            $this->page->getData(),
        );
    }

    public function testMergesWiths(): void
    {
        $this->page->with('potato', 'Cheesy peas');

        $this->assertArrayHasKey(
            'potato',
            $this->page->getData(),
        );
    }
}

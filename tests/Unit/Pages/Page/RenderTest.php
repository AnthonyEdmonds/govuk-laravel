<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Route;

class RenderTest extends TestCase
{
    protected Page $page;
    protected string $view;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        Route::get('/')->name('home');
        Route::get('/sign-out')->name('sign-out');
        
        $this->setViewErrors();
        
        $this->page = Page::create('My title')
            ->setTemplate('custom');
        
        $this->view = $this->page->render();
    }

    public function testRendersView(): void
    {
        $this->assertStringContainsString(
            'My title',
            $this->view,
        );
    }
}

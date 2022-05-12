<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Route;

class GetRouteBaseTest extends TestCase
{
    protected Form $form;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        Route::shouldReceive('currentRouteName')
            ->andReturn('test.form.start');
        
        $this->form = new TestForm();
    }

    public function testSetsRouteBase(): void
    {
        $this->assertEquals(
            'test.form',
            $this->form->getRouteBase()
        );
    }
}

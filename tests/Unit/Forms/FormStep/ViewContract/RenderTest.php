<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\FormStep\ViewContract;

use AnthonyEdmonds\GovukLaravel\Forms\FormOld;
use AnthonyEdmonds\GovukLaravel\Forms\FormStepOld;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormStepInsideSection;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormStepOutsideSection;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class RenderTest extends TestCase
{
    protected FormOld $form;
    protected FormStepOld $step;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->setViewErrors();
        
        Route::shouldReceive('currentRouteName')
            ->andReturn('my-form.create');
        
        Route::shouldReceive('getRoutes')
            ->andReturn(new RouteCollection());
        
        URL::shouldReceive('asset')
            ->andReturn('');
        
        URL::shouldReceive('route')
            ->andReturn('');
        
        $this->form = new TestForm();
    }

    public function testOutputsQuestionsPageWhenArray(): void
    {
        $this->step = new TestFormStepOutsideSection($this->form);

        $this->assertStringContainsString(
            'What are the answers?',
            $this->step->render()
        );
    }

    public function testOutputsQuestionPageWhenArray(): void
    {
        $this->step = new TestFormStepInsideSection($this->form);

        $this->assertStringContainsString(
            'My question?',
            $this->step->render()
        );
    }
}

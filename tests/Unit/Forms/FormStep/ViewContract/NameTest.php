<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\FormStep\ViewContract;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Forms\FormStep;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormStepQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class NameTest extends TestCase
{
    protected Form $form;
    protected FormStep $step;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->form = new TestForm();
        $this->step = new TestFormStepQuestion($this->form);
    }
    
    public function testReturnsKey(): void
    {
        $this->assertEquals(
            TestFormStepQuestion::KEY,
            $this->step->name()
        );
    }
}

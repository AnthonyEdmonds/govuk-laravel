<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\FormStep\ViewContract;

use AnthonyEdmonds\GovukLaravel\Forms\FormOld;
use AnthonyEdmonds\GovukLaravel\Forms\FormStepOld;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormStepInsideSection;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetDataTest extends TestCase
{
    protected FormOld $form;
    protected FormStepOld $step;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->form = new TestForm();
        $this->step = new TestFormStepInsideSection($this->form);
        $this->step->with('my-key', 'my-value');
    }
    
    public function testMergesNothingAndWiths(): void
    {
        $this->assertCount(
            1,
            $this->step->getData()
        );
    }
}

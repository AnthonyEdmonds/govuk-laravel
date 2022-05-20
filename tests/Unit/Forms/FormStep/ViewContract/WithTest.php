<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\FormStep\ViewContract;

use AnthonyEdmonds\GovukLaravel\Forms\FormOld;
use AnthonyEdmonds\GovukLaravel\Forms\FormStepOld;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormStepInsideSection;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class WithTest extends TestCase
{
    protected FormOld $form;
    protected FormStepOld $step;
    protected array $withs;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->form = new TestForm();
        $this->step = new TestFormStepInsideSection($this->form);
        $this->step->with('my-key', 'my-value');
        $this->withs = $this->step->getData();
    }

    public function testAddsValueToWith(): void
    {
        $this->assertEquals(
            'my-value',
            $this->withs['my-key']
        );
    }
}

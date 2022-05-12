<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\FormStep\ViewContract;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Forms\FormStep;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormStepQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class WithTest extends TestCase
{
    protected Form $form;
    protected FormStep $step;
    protected array $withs;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->form = new TestForm();
        $this->step = new TestFormStepQuestion($this->form);
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

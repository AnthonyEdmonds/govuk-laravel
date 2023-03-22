<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class FormTest extends TestCase
{
    protected FormModel $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        $this->subject = FormModel::factory()->make();
    }

    public function testSetsForm(): void
    {
        $this->assertInstanceOf(
            TestForm::class,
            $this->subject->form()
        );
    }

    public function testUsesStoredFormWhenSet(): void
    {
        $form = new TestForm();
        $this->subject->form = $form;

        $this->assertSame(
            $form,
            $this->subject->form(),
        );
    }
}

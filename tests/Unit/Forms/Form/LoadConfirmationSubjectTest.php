<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormNoDatabase;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class LoadConfirmationSubjectTest extends TestCase
{
    protected FormModel $subject;

    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();
    }

    public function testLoadsSubjectFromSession(): void
    {
        $this->subject = FormModel::factory()->make();
        GovukForm::flash(TestFormNoDatabase::key(), $this->subject);

        $this->form = new TestFormNoDatabase;
        $found = $this->form->loadConfirmationSubject();

        $this->assertEquals(
            $this->subject->name,
            $found->name,
        );
    }

    public function testLoadsSubjectFromDatabase(): void
    {
        $this->subject = FormModel::factory()->create();

        $this->form = new TestForm;
        $found = $this->form->loadConfirmationSubject($this->subject->id);

        $this->assertEquals(
            $this->subject->name,
            $found->name,
        );
    }
}

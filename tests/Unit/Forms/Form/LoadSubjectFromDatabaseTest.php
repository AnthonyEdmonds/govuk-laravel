<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class LoadSubjectFromDatabaseTest extends TestCase
{
    protected FormModel $subject;

    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->subject = FormModel::factory()->create();
        $this->form = new TestForm();
    }

    public function testLoadsSubjectFromDatabase(): void
    {
        $this->assertEquals(
            $this->subject->id,
            $this->form->loadSubjectFromDatabase($this->subject->id)->id,
        );
    }
}

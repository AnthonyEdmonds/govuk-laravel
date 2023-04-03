<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ConfirmationTest extends TestCase
{
    protected FormModel $subject;

    protected Page $page;

    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();
        $this->useDatabase();

        $this->subject = FormModel::factory()->create();

        $this->form = new TestForm();
        $this->page = $this->form->confirmation(Form::EDIT, $this->subject);
    }

    public function testHasTitle(): void
    {
        $this->assertEquals(
            'Application complete',
            $this->page->getData()['title']
        );
    }

    public function testHasBlade(): void
    {
        $this->assertEquals(
            'test.confirmation',
            $this->page->getData()['content']
        );
    }

    public function testHasMode(): void
    {
        $this->assertEquals(
            Form::EDIT,
            $this->page->getData()['mode'],
        );
    }

    public function testHasSubject(): void
    {
        $this->assertEquals(
            $this->subject->id,
            $this->page->getData()['subject']->id,
        );
    }
}

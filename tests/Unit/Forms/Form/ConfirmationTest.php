<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Auth\Access\AuthorizationException;

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
        $this->form = new TestForm;
    }

    public function testChecksAccess(): void
    {
        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('This action is unauthorized');

        $this->signIn(allow: false);
        $this->form->confirmation(Form::EDIT, $this->subject);
    }

    public function testHasTitle(): void
    {
        $this->signIn();
        $this->page = $this->form->confirmation(Form::EDIT, $this->subject);

        $this->assertEquals(
            'Application complete',
            $this->page->getData()['title']
        );

        $this->assertEquals(
            'test.confirmation',
            $this->page->getData()['content']
        );

        $this->assertEquals(
            Form::EDIT,
            $this->page->getData()['mode'],
        );

        $this->assertEquals(
            $this->subject->id,
            $this->page->getData()['subject']->id,
        );
    }
}

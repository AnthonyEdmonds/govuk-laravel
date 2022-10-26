<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

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

        $this->subject = new FormModel();
        $this->subject->name = 'Potato';
        $this->subject->save();

        $this->form = new TestForm();
        $this->page = $this->form->confirmation($this->subject->id);
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

    public function testHasBack(): void
    {
        $this->assertEquals(
            route('/'),
            $this->page->getData()['back']
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

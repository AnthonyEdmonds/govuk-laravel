<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\ThirdQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SummaryTest extends TestCase
{
    protected Page $page;

    protected FormModel $subject;

    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        $this->subject = FormModel::factory()->make();
        GovukForm::put(TestForm::key(), $this->subject);

        $this->form = new TestForm();
        $this->page = $this->form->summary(Form::NEW);
    }

    public function testHasTitle(): void
    {
        $this->assertEquals(
            'Review your answers',
            $this->page->getData()['title']
        );
    }

    public function testHasSummary(): void
    {
        $this->assertEquals(
            $this->subject->toSummary(true),
            $this->page->getData()['summary']
        );
    }

    public function testHasSubmitLabel(): void
    {
        $this->assertEquals(
            'Submit',
            $this->page->getData()['submitButtonLabel']
        );
    }

    public function testHasAction(): void
    {
        $this->assertEquals(
            route('forms.summary', [
                TestForm::key(),
                Form::NEW,
            ]),
            $this->page->getData()['action']
        );
    }

    public function testHasBack(): void
    {
        $this->assertEquals(
            route('forms.question', [
                TestForm::key(),
                Form::NEW,
                ThirdQuestion::key(),
            ]),
            $this->page->getData()['back']
        );
    }

    public function testBackExitsWhenEditing(): void
    {
        $this->page = $this->form->summary(Form::EDIT);

        $this->assertEquals(
            route('/'),
            $this->page->getData()['back']
        );
    }

    public function testHasMethod(): void
    {
        $this->assertEquals(
            Page::POST_METHOD,
            $this->page->getData()['method']
        );
    }

    public function testHasBlade(): void
    {
        $this->assertEquals(
            null,
            $this->page->getData()['content']
        );
    }

    public function testHasCancelButtonLabel(): void
    {
        $this->assertEquals(
            'Cancel and exit',
            $this->page->getData()['otherButtonLabel']
        );
    }

    public function testHasCancelRoute(): void
    {
        $this->assertEquals(
            route('/'),
            $this->page->getData()['otherButtonHref']
        );
    }

    public function testHasMode(): void
    {
        $this->assertEquals(
            Form::NEW,
            $this->page->getData()['mode']
        );
    }

    public function testHasSubject(): void
    {
        $this->assertInstanceOf(
            FormModel::class,
            $this->page->getData()['subject']
        );
    }
}

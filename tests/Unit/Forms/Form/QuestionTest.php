<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\SecondQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class QuestionTest extends TestCase
{
    protected Page $page;
    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        GovukForm::set(TestForm::key(), new FormModel());

        $this->form = new TestForm();
        $this->page = $this->form->question(
            Form::NEW,
            FirstQuestion::key(),
        );
    }

    public function testHasQuestionWhenSingle(): void
    {
        $this->assertEquals(
            'Test question one',
            $this->page->getData()['title']
        );
    }

    public function testHasTitleWhenMultiple(): void
    {
        $this->page = $this->form->question(
            Form::NEW,
            SecondQuestion::key(),
        );

        $this->assertEquals(
            'The Second Question',
            $this->page->getData()['title']
        );
    }

    public function testHasQuestionsWhenMultiple(): void
    {
        $this->page = $this->form->question(
            Form::NEW,
            SecondQuestion::key(),
        );

        $this->assertEquals(
            'Test question two A',
            $this->page->getData()['questions'][0]->label
        );

        $this->assertEquals(
            'Test question two B',
            $this->page->getData()['questions'][1]->label
        );
    }

    public function testHasSubmitButtonLabel(): void
    {
        $this->assertEquals(
            'Save and continue',
            $this->page->getData()['submitButtonLabel']
        );
    }

    public function testHasAction(): void
    {
        $this->assertEquals(
            route('forms.question', [
                TestForm::key(),
                Form::NEW,
                FirstQuestion::key(),
            ]),
            $this->page->getData()['action']
        );
    }

    public function testHasBack(): void
    {
        $this->assertEquals(
            FormModel::startFormRoute(),
            $this->page->getData()['back']
        );
    }

    public function testHasMethod(): void
    {
        $this->assertEquals(
            'post',
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

    public function testHasOtherButtonLabel(): void
    {
        $this->assertEquals(
            Page::OTHER_BUTTON_LABEL,
            $this->page->getData()['otherButtonLabel']
        );
    }

    public function testHasOtherButtonRoute(): void
    {
        $this->assertEquals(
            null,
            $this->page->getData()['otherButtonHref']
        );
    }

    public function testHasSubmitButtonType(): void
    {
        $this->assertEquals(
            Page::NORMAL_BUTTON,
            $this->page->getData()['submitButtonType']
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

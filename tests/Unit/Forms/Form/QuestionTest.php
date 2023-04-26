<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\SecondQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\ThirdQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormAlt;
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
    }

    public function testHasQuestionWhenSingle(): void
    {
        $this->makePage();

        $this->assertEquals(
            'Test question one',
            $this->page->getData()['title']
        );
    }

    public function testHasTitleWhenMultiple(): void
    {
        $this->makePage();

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
        $this->makePage();

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
        $this->makePage();

        $this->assertEquals(
            'Save and continue',
            $this->page->getData()['submitButtonLabel']
        );
    }

    public function testHasAction(): void
    {
        $this->makePage();

        $this->assertEquals(
            route('forms.question', [
                TestForm::key(),
                Form::NEW,
                FirstQuestion::key(),
            ]),
            $this->page->getData()['action']
        );
    }

    public function testHasBackToPreviousQuestionWhenNew(): void
    {
        $this->makePage(TestForm::class, Form::NEW, false);

        $this->assertEquals(
            route('forms.question', [
                TestForm::key(),
                Form::NEW,
                SecondQuestion::key(),
            ]),
            $this->page->getData()['back']
        );
    }

    public function testHasBackToStartWhenBladeExistsAndFirstQuestion(): void
    {
        $this->makePage();

        $this->assertEquals(
            FormModel::startFormRoute(),
            $this->page->getData()['back']
        );
    }

    public function testHasBackToExitWhenBladeMissingAndFirstQuestion(): void
    {
        $this->makePage(TestFormAlt::class);

        $this->assertEquals(
            route('/'),
            $this->page->getData()['back']
        );
    }

    public function testHasBackToSummaryWhenEditing(): void
    {
        $this->makePage(TestForm::class, Form::EDIT);

        $this->assertEquals(
            route('forms.summary', [TestForm::key(), Form::EDIT]),
            $this->page->getData()['back']
        );
    }

    public function testHasMethod(): void
    {
        $this->makePage();

        $this->assertEquals(
            Page::POST_METHOD,
            $this->page->getData()['method']
        );
    }

    public function testHasBlade(): void
    {
        $this->makePage();

        $this->assertEquals(
            null,
            $this->page->getData()['content']
        );
    }

    public function testHasOtherButtonLabel(): void
    {
        $this->makePage();

        $this->assertEquals(
            'Skip and continue',
            $this->page->getData()['otherButtonLabel']
        );
    }

    public function testHasOtherButtonRoute(): void
    {
        $this->makePage();

        $this->assertEquals(
            $this->form::skipRoute(Form::NEW, FirstQuestion::key()),
            $this->page->getData()['otherButtonHref']
        );
    }

    public function testHasSubmitButtonType(): void
    {
        $this->makePage();

        $this->assertEquals(
            Page::NORMAL_BUTTON,
            $this->page->getData()['submitButtonType']
        );
    }

    public function testHasMode(): void
    {
        $this->makePage();

        $this->assertEquals(
            Form::NEW,
            $this->page->getData()['mode']
        );
    }

    public function testHasSubject(): void
    {
        $this->makePage();

        $this->assertInstanceOf(
            FormModel::class,
            $this->page->getData()['subject']
        );
    }

    protected function makePage(
        string $formClass = TestForm::class,
        string $mode = Form::NEW,
        bool $firstQuestion = true,
    ): void {
        GovukForm::put($formClass::key(), new FormModel());

        $this->form = new $formClass();

        $this->page = $this->form->question(
            $mode,
            $firstQuestion === true
                ? FirstQuestion::key()
                : ThirdQuestion::key(),
        );
    }
}

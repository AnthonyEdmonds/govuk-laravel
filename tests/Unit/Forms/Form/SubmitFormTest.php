<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class SubmitFormTest extends TestCase
{
    protected FormModel $subject;
    protected RedirectResponse $response;
    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();
        $this->useDatabase();

        $this->subject = new FormModel();
        $this->subject->name = 'Potato';
        GovukForm::put(TestForm::key(), $this->subject);

        $this->form = new TestForm();
    }

    public function testUpdatesWhenEdit(): void
    {
        $this->submit(Form::EDIT);

        // TODO Change form flow to load database into cache when starting form
        // TODO Incrementally change model, then save at end

        $this->assertDatabaseHas('form_models', [
            'name' => 'Carrot',
        ]);
    }

    public function testStoresWhenNew(): void
    {
        $this->submit(Form::NEW);

        $this->assertDatabaseHas('form_models', [
            'name' => 'Potato',
        ]);
    }

    public function testClearsCache(): void
    {
        $this->submit(Form::NEW);

        $this->assertFalse(
            GovukForm::has(TestForm::key())
        );
    }

    public function testRedirects(): void
    {
        $this->submit(Form::NEW);

        $this->assertEquals(
            route('forms.confirmation', [
                TestForm::key(),
                Form::NEW,
                FormModel::first()->id,
            ]),
            $this->response->getTargetUrl()
        );
    }

    protected function submit(string $mode, int $subjectKey = null): void
    {
        $this->response = $this->form->submitForm($mode, $subjectKey);
    }
}

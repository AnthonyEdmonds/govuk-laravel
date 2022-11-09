<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class SubmitTest extends TestCase
{
    protected FormModel $subject;
    protected RedirectResponse $response;
    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();
        $this->useDatabase();

        $this->subject = FormModel::factory()->make();
        GovukForm::put(TestForm::key(), $this->subject);

        $this->form = new TestForm();
        $this->response = $this->form->submit(Form::NEW);
    }

    public function testRunsSubmitForm(): void
    {
        $this->assertDatabaseHas('form_models', [
            'name' => $this->subject->name,
        ]);
    }

    public function testClearsCache(): void
    {
        $this->assertFalse(
            GovukForm::has(TestForm::key())
        );
    }

    public function testRedirects(): void
    {
        $this->assertEquals(
            route('forms.confirmation', [
                TestForm::key(),
                Form::NEW,
                FormModel::first()->id,
            ]),
            $this->response->getTargetUrl()
        );
    }
}

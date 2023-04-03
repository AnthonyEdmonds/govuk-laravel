<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormAlt;
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
    }

    public function testRunsSubmitForm(): void
    {
        $this->makeRequest(TestForm::class);

        $this->assertDatabaseHas('form_models', [
            'name' => $this->subject->name,
        ]);
    }

    public function testClearsCache(): void
    {
        $this->makeRequest(TestForm::class);

        $this->assertFalse(
            GovukForm::has(TestForm::key())
        );
    }

    public function testRedirects(): void
    {
        $this->makeRequest(TestForm::class);

        $this->assertEquals(
            route('forms.confirmation', [
                TestForm::key(),
                Form::NEW,
                FormModel::first()->id,
            ]),
            $this->response->getTargetUrl()
        );
    }

    public function testExitsWhenNoConfirmationBlade(): void
    {
        $this->makeRequest(TestFormAlt::class);

        $this->assertEquals(
            route('/'),
            $this->response->getTargetUrl()
        );
    }

    protected function makeRequest(string $formClass): void
    {
        $this->subject = FormModel::factory()->make();
        GovukForm::put($formClass::key(), $this->subject);

        $this->form = new $formClass();

        $this->response = $this->form->submit(Form::NEW);
    }
}

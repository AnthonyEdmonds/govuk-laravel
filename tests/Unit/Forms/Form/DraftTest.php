<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class DraftTest extends TestCase
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
        $this->response = $this->form->draft(Form::NEW);
    }

    public function testRunsSubmitDraft(): void
    {
        $this->assertDatabaseHas('form_models', [
            'name' => $this->subject->name,
        ]);
    }

    public function testExitsWhenNoConfirmationBlade(): void
    {
        $this->assertEquals(
            route('/'),
            $this->response->getTargetUrl()
        );
    }
}

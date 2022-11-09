<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class EditTest extends TestCase
{
    protected FormModel $subject;
    protected RedirectResponse $response;
    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();
        $this->useDatabase();

        $this->subject = FormModel::factory()->create();

        $this->form = new TestForm();
        $this->response = $this->form->edit($this->subject->id);
    }

    public function testSetsFormSession(): void
    {
        $this->assertEquals(
            $this->subject->id,
            Session::get(TestForm::key())->id,
        );
    }

    public function testRedirectsToSummary(): void
    {
        $this->assertEquals(
            route('forms.summary', [
                TestForm::key(),
                Form::EDIT,
            ]),
            $this->response->getTargetUrl()
        );
    }
}

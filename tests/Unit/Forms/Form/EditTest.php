<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Auth\Access\AuthorizationException;
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
    }

    public function testChecksAccess(): void
    {
        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('This action is unauthorized');

        $this->signIn(allow: false);
        $this->form->edit($this->subject);
    }

    public function testSetsFormSession(): void
    {
        $this->signIn();
        $this->response = $this->form->edit($this->subject);

        $this->assertEquals(
            $this->subject->id,
            Session::get(TestForm::key())->id,
        );

        $this->assertEquals(
            route('forms.summary', [
                TestForm::key(),
                Form::EDIT,
            ]),
            $this->response->getTargetUrl()
        );
    }
}

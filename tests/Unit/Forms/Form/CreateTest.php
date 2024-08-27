<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class CreateTest extends TestCase
{
    protected RedirectResponse $response;

    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        $this->form = new TestForm();
    }

    public function testChecksAccess(): void
    {
        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('This action is unauthorized');

        $this->signIn(allow: false);
        $this->form->create();
    }

    public function testSetsFormSession(): void
    {
        $this->signIn();
        $this->response = $this->form->create();

        $this->assertInstanceOf(
            FormModel::class,
            Session::get(TestForm::key()),
        );

        $this->assertEquals(
            route('forms.question', [
                TestForm::key(),
                TestForm::NEW,
                FirstQuestion::key(),
            ]),
            $this->response->getTargetUrl(),
        );
    }
}

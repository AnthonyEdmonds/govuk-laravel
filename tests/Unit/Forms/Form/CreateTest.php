<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
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
        $this->response = $this->form->create();
    }

    public function testSetsFormSession(): void
    {
        $this->assertInstanceOf(
            FormModel::class,
            Session::get(TestForm::key())
        );
    }

    public function testRedirectsToFirstQuestion(): void
    {
        $this->assertEquals(
            route('forms.question', [
                TestForm::key(),
                TestForm::NEW,
                FirstQuestion::key(),
            ]),
            $this->response->getTargetUrl()
        );
    }
}

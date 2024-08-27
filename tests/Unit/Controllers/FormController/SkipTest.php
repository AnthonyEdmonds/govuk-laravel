<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Controllers\FormController;

use AnthonyEdmonds\GovukLaravel\Controllers\FormController;
use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\SecondQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class SkipTest extends TestCase
{
    protected FormController $controller;

    protected RedirectResponse $response;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        $this->signIn();

        GovukForm::put(TestForm::key(), new FormModel());

        $this->controller = new FormController();
    }

    public function testRedirects(): void
    {
        $this->makeRequest();

        $this->assertEquals(
            route('forms.question', [
                TestForm::key(),
                Form::NEW,
                SecondQuestion::key(),
            ]),
            $this->response->getTargetUrl(),
        );
    }

    protected function makeRequest(): void
    {
        $this->response = $this->controller->skip(
            TestForm::key(),
            Form::NEW,
            FirstQuestion::key(),
        );
    }
}

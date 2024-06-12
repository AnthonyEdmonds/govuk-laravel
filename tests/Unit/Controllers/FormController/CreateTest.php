<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Controllers\FormController;

use AnthonyEdmonds\GovukLaravel\Controllers\FormController;
use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class CreateTest extends TestCase
{
    protected FormController $controller;

    protected RedirectResponse $response;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        $this->signIn();

        $this->controller = new FormController();
    }

    public function testRedirects(): void
    {
        $this->makeRequest();

        $this->assertEquals(
            route('forms.question', [
                TestForm::key(),
                Form::NEW,
                FirstQuestion::key(),
            ]),
            $this->response->getTargetUrl(),
        );
    }

    protected function makeRequest(): void
    {
        $this->response = $this->controller->create(TestForm::key());
    }
}

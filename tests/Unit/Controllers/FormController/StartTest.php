<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Controllers\FormController;

use AnthonyEdmonds\GovukLaravel\Controllers\FormController;
use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormAlt;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StartTest extends TestCase
{
    protected Form $form;

    protected FormController $controller;

    protected View|RedirectResponse $response;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        $this->signIn();

        $this->controller = new FormController();
    }

    public function testHasTemplate(): void
    {
        $this->makeRequest(TestForm::key());

        $this->assertEquals(
            'test.start',
            $this->response->name(),
        );
    }

    public function testRedirectsWhenNoBlade(): void
    {
        $this->makeRequest(TestFormAlt::key());

        $this->assertEquals(
            route('forms.question', [TestFormAlt::key(), Form::NEW, FirstQuestion::key()]),
            $this->response->getTargetUrl(),
        );
    }

    protected function makeRequest(string $formKey): void
    {
        $this->response = $this->controller->start($formKey);
    }
}

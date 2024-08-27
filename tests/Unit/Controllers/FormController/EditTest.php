<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Controllers\FormController;

use AnthonyEdmonds\GovukLaravel\Controllers\FormController;
use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class EditTest extends TestCase
{
    protected FormController $controller;

    protected FormModel $subject;

    protected RedirectResponse $response;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();
        $this->useDatabase();

        $this->signIn();

        $this->subject = FormModel::factory()->create();

        $this->controller = new FormController;
    }

    public function testRedirects(): void
    {
        $this->makeRequest();

        $this->assertEquals(
            route('forms.summary', [
                TestForm::key(),
                Form::EDIT,
            ]),
            $this->response->getTargetUrl(),
        );
    }

    protected function makeRequest(): void
    {
        $this->response = $this->controller->edit(TestForm::key(), $this->subject->id);
    }
}

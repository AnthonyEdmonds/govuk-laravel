<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Controllers\FormController;

use AnthonyEdmonds\GovukLaravel\Controllers\FormController;
use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Contracts\View\View;

class SummaryTest extends TestCase
{
    protected FormController $controller;

    protected View $response;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        $this->signIn();

        GovukForm::put(TestForm::key(), new FormModel);

        $this->controller = new FormController;
    }

    public function testHasTemplate(): void
    {
        $this->makeRequest();

        $this->assertEquals(
            'summary',
            $this->response->name(),
        );
    }

    protected function makeRequest(): void
    {
        $this->response = $this->controller->summary(
            TestForm::key(),
            Form::NEW,
        );
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\FormRequests\NameFormRequest;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\SecondQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class StoreTest extends TestCase
{
    protected FormModel $subject;

    protected NameFormRequest $request;

    protected RedirectResponse $response;

    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        $this->subject = new FormModel();
        GovukForm::put(TestForm::key(), $this->subject);

        $this->form = new TestForm();
    }

    public function testRunsValidation(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The name field is required.');

        $this->makeRequest(null);
    }

    public function testRunsStore(): void
    {
        $this->makeRequest('potato');

        $this->assertEquals(
            'potato',
            $this->subject->name
        );
    }

    public function testUpdatesCache(): void
    {
        $this->makeRequest('potato');

        $this->assertEquals(
            'potato',
            GovukForm::get(TestForm::key())->name
        );
    }

    public function testRedirectsToNext(): void
    {
        $this->makeRequest('potato');

        $this->assertEquals(
            route('forms.question', [
                TestForm::key(),
                Form::NEW,
                SecondQuestion::key(),
            ]),
            $this->response->getTargetUrl(),
        );
    }

    protected function makeRequest(?string $name): void
    {
        $this->request = new NameFormRequest([
            'name' => $name,
        ]);

        $this->response = $this->form->store(
            $this->request,
            Form::NEW,
            FirstQuestion::key()
        );
    }
}

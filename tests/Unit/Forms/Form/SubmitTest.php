<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormAlt;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormNoDatabase;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class SubmitTest extends TestCase
{
    protected FormModel $subject;

    protected RedirectResponse $response;

    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();
        $this->useDatabase();

        $this->subject = FormModel::factory()->make();
    }

    public function testChecksAccess(): void
    {
        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('This action is unauthorized');

        $this->makeRequest(TestForm::class, false);
    }

    public function testRunsSubmitForm(): void
    {
        $this->makeRequest(TestForm::class);

        $this->assertDatabaseHas('form_models', [
            'name' => $this->subject->name,
        ]);
    }

    public function testClearsCache(): void
    {
        $this->makeRequest(TestForm::class);

        $this->assertFalse(
            GovukForm::has(TestForm::key())
        );
    }

    public function testFlashesCacheWhenNoDatabase(): void
    {
        $this->makeRequest(TestFormNoDatabase::class);

        $this->assertTrue(
            GovukForm::has(TestFormNoDatabase::key())
        );
    }

    public function testRedirects(): void
    {
        $this->makeRequest(TestForm::class);

        $this->assertEquals(
            route('forms.confirmation', [
                TestForm::key(),
                Form::NEW,
                FormModel::first()->id,
            ]),
            $this->response->getTargetUrl()
        );
    }

    public function testRedirectsWhenNoDatabase(): void
    {
        $this->makeRequest(TestFormNoDatabase::class);

        $this->assertEquals(
            route('forms.confirmation', [
                TestFormNoDatabase::key(),
                Form::NEW,
            ]),
            $this->response->getTargetUrl()
        );
    }

    public function testExitsWhenNoConfirmationBlade(): void
    {
        $this->makeRequest(TestFormAlt::class);

        $this->assertEquals(
            route('/'),
            $this->response->getTargetUrl()
        );
    }

    public function testCancelsWhenCannotSubmit(): void
    {
        $this->subject->name = null;

        $this->makeRequest(TestForm::class);

        $this->assertEquals(
            route('forms.summary', [
                TestForm::key(),
                Form::NEW,
            ]),
            $this->response->getTargetUrl(),
        );

        $this->assertEquals(
            'You must put a name',
            $this->response->getSession()->get('errors')->first('content')
        );
    }

    /** @param class-string<Form> $formClass */
    protected function makeRequest(string $formClass, bool $allow = true): void
    {
        $this->signIn(allow: $allow);
        GovukForm::put($formClass::key(), $this->subject);

        $this->form = new $formClass();

        $this->response = $this->form->submit(Form::NEW);
    }
}

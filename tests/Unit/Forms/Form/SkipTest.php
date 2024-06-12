<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\SecondQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class SkipTest extends TestCase
{
    protected FormModel $subject;

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

    public function testChecksAccess(): void
    {
        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('This action is unauthorized');

        $this->makeRequest(allow: false);
    }

    public function testRunsSkip(): void
    {
        $this->makeRequest();

        $this->assertEquals(
            'Skipped',
            $this->subject->name
        );
    }

    public function testUpdatesCache(): void
    {
        $this->makeRequest();

        $this->assertEquals(
            'Skipped',
            GovukForm::get(TestForm::key())->name
        );
    }

    public function testRedirectsToNext(): void
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

    protected function makeRequest(bool $allow = true): void
    {
        $this->signIn(allow: $allow);

        $this->response = $this->form->skip(
            Form::NEW,
            FirstQuestion::key()
        );
    }
}

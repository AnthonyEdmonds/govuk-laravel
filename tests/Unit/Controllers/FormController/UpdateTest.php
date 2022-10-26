<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Controllers\FormController;

use AnthonyEdmonds\GovukLaravel\Controllers\FormController;
use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\FormRequests\NameFormRequest;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\SecondQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\Models\User;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class UpdateTest extends TestCase
{
    protected FormController $controller;
    protected FormModel $subject;
    protected NameFormRequest $request;
    protected RedirectResponse $response;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();
        $this->useDatabase();

        $this->user = new User();
        $this->signIn($this->user);

        $this->request = new NameFormRequest([
            'name' => 'potato',
        ]);

        $this->subject = new FormModel();
        $this->subject->name = 'Potato';
        $this->subject->save();

        GovukForm::put(TestForm::key(), $this->subject);

        $this->controller = new FormController();
    }

    public function testChecksAccess(): void
    {
        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('This action is unauthorized');

        $this->makeRequest(false);
    }

    public function testRedirects(): void
    {
        $this->makeRequest();

        $this->assertEquals(
            route('forms.question', [
                TestForm::key(),
                Form::NEW,
                SecondQuestion::key(),
                $this->subject->id,
            ]),
            $this->response->getTargetUrl(),
        );
    }

    protected function makeRequest(bool $allow = true): void
    {
        $this->user->allow = $allow;

        $this->response = $this->controller->update(
            $this->request,
            TestForm::key(),
            Form::NEW,
            FirstQuestion::key(),
            $this->subject->id,
        );
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Templates;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Route;
use NunoMaduro\LaravelMojito\ViewAssertion;

class QuestionTest extends TestCase
{
    public function testHasForm(): void
    {
        $this->makeComponent()
            ->first('form')
            ->hasAttribute('action', 'my-action')
            ->at('input', 1)
            ->hasAttribute('value', 'POST');
    }

    public function testHasQuestions(): void
    {
        $this->makeComponent([
            'questions' => [
                GovukQuestion::hidden('my-name', 'my-value'),
            ]
        ])
            ->last('input')
            ->hasAttribute('name', 'my-name')
            ->hasAttribute('value', 'my-value');
    }

    public function testHasSubmitButton(): void
    {
        $this->makeComponent()
            ->first('form > div > button')
            ->contains('Submit label');
    }

    public function testHasOtherButton(): void
    {
        $this->makeComponent([
            'otherButtonHref' => 'other-action',
            'otherButtonLabel' => 'Other label',
        ])
            ->first('form > div > a')
            ->hasAttribute('href', 'other-action')
            ->contains('Other label');
    }
    
    protected function makeComponent(array $data = []): ViewAssertion
    {
        Route::get('/home')->name('home');
        Route::get('/sign-out')->name('sign-out');
        
        $this->setViewErrors();

        return $this->assertView('govuk::templates.question', [
            'action' => $data['action'] ?? 'my-action',
            'method' => $data['method'] ?? 'POST',
            'questions' => $data['questions'] ?? [],
            'submitButtonLabel' => $data['submitButtonLabel'] ?? 'Submit label',
            'submitButtonType' => $data['submitButtonType'] ?? Page::NORMAL_BUTTON,
            'title' => 'My page title',
            'otherButtonHref' => $data['otherButtonHref'] ?? null,
            'otherButtonLabel' => $data['otherButtonLabel'] ?? null,
            'otherButtonMethod' => $data['otherButtonMethod'] ?? null,
        ]);
    }
}

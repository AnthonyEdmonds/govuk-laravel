<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Route;
use NunoMaduro\LaravelMojito\ViewAssertion;

class FeedbackTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/feedback')->name('feedback');
    }

    public function test(): void
    {
        $feedback = $this->makeComponent();

        $feedback->first('h2')->contains('My header');

        $feedback->first('div.govuk-feedback__body')
            ->contains('My description')
            ->first('a')
            ->hasAttribute('href', route('feedback'))
            ->contains('My link');
    }

    protected function makeComponent(): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.feedback', [
            'description' => 'My description',
            'header' => 'My header',
            'link_label' => 'My link',
            'route' => 'feedback',
        ]);
    }
}

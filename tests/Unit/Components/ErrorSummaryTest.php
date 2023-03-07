<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ErrorSummaryTest extends TestCase
{
    public function testHasMessages(): void
    {
        $summary = $this->makeComponent()
            ->first('div');

        $summary
            ->first('h2')
            ->contains('My title');

        $summary
            ->at('div > ul > li', 0)
            ->first('a')
            ->hasAttribute('href', '#' . GovukQuestion::dotsToBrackets('id-1'))
            ->contains('Message one');

        $summary
            ->at('div > ul > li', 1)
            ->first('a')
            ->hasAttribute('href', '#' . GovukQuestion::dotsToBrackets('id-2'))
            ->contains('Message two');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.error-summary', [
            'messages' => [
                'id-1' => 'Message one',
                'id-2' => 'Message two',
            ],
            'title' => 'My title'
        ]);
    }
}


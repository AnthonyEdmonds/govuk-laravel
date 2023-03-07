<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class TextInputTest extends TestCase
{
    public function test(): void
    {
        $this->makeComponent();
    }
    
    protected function makeComponent(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.', [
            
        ]);
    }
}


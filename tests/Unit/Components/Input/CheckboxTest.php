<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\Input;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class CheckboxTest extends TestCase
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

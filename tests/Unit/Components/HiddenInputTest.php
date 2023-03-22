<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class HiddenInputTest extends TestCase
{
    public function testHasId(): void
    {
        $this->makeComponent()
            ->first('input')
            ->hasAttribute('id', 'my-id');
    }

    public function testHasName(): void
    {
        $this->makeComponent()
            ->first('input')
            ->hasAttribute('name', 'my-name');
    }

    public function testHasType(): void
    {
        $this->makeComponent()
            ->first('input')
            ->hasAttribute('type', 'hidden');
    }

    public function testHasValue(): void
    {
        $this->makeComponent()
            ->first('input')
            ->hasAttribute('value', 'my-value');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.hidden-input', [
            'id' => $data['id'] ?? 'my-id',
            'name' => $data['name'] ?? 'my-name',
            'value' => $data['value'] ?? 'my-value',
        ]);
    }
}

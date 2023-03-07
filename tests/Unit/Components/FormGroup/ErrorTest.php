<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\FormGroup;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ErrorTest extends TestCase
{
    public function testHasError(): void
    {
        $this->setViewErrors([
            'my-name' => 'This is bad',
        ]);

        $this->makeComponent()
            ->first('p')
            ->hasAttribute('id', 'my-id-error')
            ->contains('This is bad');
    }

    public function testHidesWhenNoError(): void
    {
        $this->expectEmptyNodeList();

        $this->setViewErrors();
        $this->makeComponent();
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.form-group.error', [
            'id' => $data['id'] ?? 'my-id',
            'name' => $data['name'] ?? 'my-name',
        ]);
    }
}


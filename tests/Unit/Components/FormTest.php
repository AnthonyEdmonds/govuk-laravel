<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class FormTest extends TestCase
{
    public function testMakesForm(): void
    {
        $this->makeComponent([
            'method' => 'get',
        ])
            ->first('form')
            ->hasAttribute('action', 'my-action')
            ->hasAttribute('method', 'get')
            ->contains('My content');
    }

    public function testAddsCsrfFields(): void
    {
        $form = $this->makeComponent()
            ->first('form');

        $form->at('form > input', 0)
            ->hasAttribute('name', '_token');

        $form->at('form > input', 1)
            ->hasAttribute('name', '_method')
            ->contains('post');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.form', [
            'action' => $data['action'] ?? 'my-action',
            'method' => $data['method'] ?? 'post',
        ]);
    }
}


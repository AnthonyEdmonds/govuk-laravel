<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class FormGroupTest extends TestCase
{
    public function testMakesFormGroup(): void
    {
        $this->setViewErrors();

        $this->makeComponent()
            ->first('div')
            ->hasClass('govuk-form-group')
            ->contains('My content');
    }

    public function testFormatsWithErrors(): void
    {
        $this->setViewErrors(['my-name' => 'My error']);

        $this->makeComponent([
            'data_module' => 'My data module',
            'password' => true,
        ])
            ->first('div')
            ->hasAttribute('data-module', 'My data module')
            ->hasClass('govuk-form-group--error')
            ->hasClass('govuk-password-input');
    }

    public function testHasCharacterCounter(): void
    {
        $this->setViewErrors();

        $this->makeComponent([
            'count' => 12,
            'threshold' => 50,
        ])
            ->first('div')
            ->hasAttribute('data-maxlength', '12')
            ->hasAttribute('data-threshold', '50')
            ->contains('My content')
            ->first('div > div')
            ->hasAttribute('id', 'my-id-info');
    }

    public function testHasWordsCounter(): void
    {
        $this->setViewErrors();

        $this->makeComponent([
            'threshold' => 50,
            'words' => 12,
        ])
            ->first('div')
            ->hasAttribute('data-maxwords', '12')
            ->hasAttribute('data-threshold', '50');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.form-group', [
            'count' => $data['count'] ?? null,
            'dataModule' => $data['data_module'] ?? 'my-data-module',
            'id' => $data['id'] ?? 'my-id',
            'name' => $data['name'] ?? 'my-name',
            'password' => $data['password'] ?? false,
            'threshold' => $data['threshold'] ?? null,
            'words' => $data['words'] ?? null,
        ]);
    }
}

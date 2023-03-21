<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class TextareaTest extends TestCase
{
    public function testHasCount(): void
    {
        $this->makeComponent([
            'count' => 3
        ])
            ->first('div')
            ->hasAttribute('data-maxlength', '3');
    }

    public function testHasId(): void
    {
        $group = $this->makeComponent();
        
        $group->last('div > div')
            ->hasAttribute('id', 'my-id-info');
        
        $group->first('label')
            ->hasAttribute('for', 'my-id');
        
        $group->first('textarea')
            ->hasAttribute('id', 'my-id');
    }

    public function testHasThreshold(): void
    {
        $this->makeComponent([
            'threshold' => 50,
        ])
            ->first('div')
            ->hasAttribute('data-threshold', '50');
    }
    
    public function testHasWords(): void
    {
        $this->makeComponent([
            'words' => 3
        ])
            ->first('div')
            ->hasAttribute('data-maxwords', '3');
    }

    public function testHasName(): void
    {
        $this->makeComponent()
            ->first('textarea')
            ->hasAttribute('name', 'my-name');
    }

    public function testHasLabel(): void
    {
        $this->makeComponent()
            ->first('label')
            ->contains('My label');
    }

    public function testHasLabelSize(): void
    {
        $this->makeComponent()
            ->first('label')
            ->hasClass('govuk-label--s');
    }

    public function testIsTitle(): void
    {
        $this->makeComponent([
            'isTitle' => true,
        ])
            ->has('div > div > h1');
    }

    public function testHasHint(): void
    {
        $group = $this->makeComponent([
            'hint' => 'My hint'
        ])
            ->first('div > div');
        
        $group->first('div.govuk-hint')
            ->hasAttribute('id', 'my-id-hint')
            ->contains('My hint');
        
        $group->first('textarea')
            ->hasAttribute('aria-describedby', 'my-id-hint');
    }

    public function testHasError(): void
    {
        $group = $this->makeComponent([], [
            'my-name' => 'An error',
        ])
            ->first('div > div');
        
        $group->first('p.govuk-error-message')
            ->hasAttribute('id', 'my-id-error')
            ->contains('An error');
        
        $group->first('textarea')
            ->hasAttribute('aria-describedby', ' my-id-error')
            ->hasClass('govuk-textarea--error');
    }

    public function testHasAutocomplete(): void
    {
        $this->makeComponent()
            ->first('textarea')
            ->hasAttribute('autocomplete', 'on');
    }

    public function testHasPlaceholder(): void
    {
        $this->makeComponent([
            'placeholder' => 'My placeholder'
        ])
            ->first('textarea')
            ->hasAttribute('placeholder', 'My placeholder');
    }

    public function testHasRows(): void
    {
        $this->makeComponent()
            ->first('textarea')
            ->hasAttribute('rows', '5');
    }

    public function testHasValue(): void
    {
        $this->makeComponent()
            ->first('textarea')
            ->contains('My value');
    }

    public function testHasSpellcheck(): void
    {
        $this->makeComponent([
            'spellcheck' => true,
        ])
            ->first('textarea')
            ->hasAttribute('spellcheck', 'true');
    }

    public function testHasInputmode(): void
    {
        $this->makeComponent()
            ->first('textarea')
            ->hasAttribute('inputmode', 'text');
    }
    
    public function testHasOld()
    {
        $this->setRequestOld([
            'my-name' => 'Potato'
        ]);

        $this->makeComponent()
            ->first('textarea')
            ->contains('Potato');
    }
    
    protected function makeComponent(array $data = [], array $errors = []): ViewAssertion
    {
        $this->setViewErrors($errors);
        
        return $this->assertView('govuk::components.textarea', [
            'autocomplete' => $data['autocomplete'] ?? 'on',
            'count' => $data['count'] ?? null,
            'hint' => $data['hint'] ?? null,
            'id' => $data['id'] ?? 'my-id',
            'inputmode' => $data['inputmode'] ?? 'text',
            'label' => $data['label'] ?? 'My label',
            'labelSize' => $data['labelSize'] ?? 's',
            'name' => $data['name'] ?? 'my-name',
            'placeholder' => $data['placeholder'] ?? null,
            'rows' => $data['rows'] ?? 5,
            'spellcheck' => $data['spellcheck'] ?? 'false',
            'threshold' => $data['threshold'] ?? null,
            'isTitle' => $data['isTitle'] ?? false,
            'value' => $data['value'] ?? 'My value',
            'words' => $data['words'] ?? null,
        ]);
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class FileUploadTest extends TestCase
{
    public function testHasAccept(): void
    {
        $this->makeComponent()
            ->first('input')
            ->hasAttribute('accept', '*');
    }

    public function testHasHint(): void
    {
        $group = $this->makeComponent([
            'hint' => 'My hint',
        ])->first('div');
        
        $group->first('div.govuk-hint')
            ->hasAttribute('id', 'my-id-hint')
            ->contains('My hint');
        
        $group->first('input')
            ->hasAttribute('aria-describedby', 'my-id-hint');
    }

    public function testHasId(): void
    {
        $group = $this->makeComponent();
        
        $group->first('label')
            ->hasAttribute('for', 'my-id');
        
        $group->first('input')
            ->hasAttribute('id', 'my-id');
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

    public function testHasName(): void
    {
        $this->makeComponent()
            ->first('input')
            ->hasAttribute('name', 'my-name');
    }

    public function testHasIsTitle(): void
    {
        $this->makeComponent([
            'isTitle' => true,
        ])
            ->has('div > h1');
    }
    
    public function testHasErrors(): void
    {
        $group = $this->makeComponent([], [
            'my-name' => 'An error',
        ]);
        
        $group->first('p.govuk-error-message')
            ->hasAttribute('id', 'my-id-error')
            ->contains('An error');
        
        $group->first('input')
            ->hasAttribute('aria-describedby', ' my-id-error')
            ->hasClass('govuk-file-upload--error');
    }
    
    protected function makeComponent(array $data = [], array $errors = []): ViewAssertion
    {
        $this->setViewErrors($errors);
        
        return $this->assertView('govuk::components.file-upload', [
            'accept' => $data['accept'] ?? '*',
            'hint' => $data['hint'] ?? null,
            'id' => $data['id'] ?? 'my-id',
            'label' => $data['label'] ?? 'My label',
            'labelSize' => $data['labelSize'] ?? 's',
            'name' => $data['name'] ?? 'my-name',
            'isTitle' => $data['isTitle'] ?? false,
        ]);
    }
}


<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\FormGroup;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class LabelTest extends TestCase
{
    public function testHasLabel(): void
    {
        $this->makeComponent()
            ->first('label')
            ->hasClass('govuk-label--s')
            ->hasAttribute('for', 'my-id')
            ->contains('My label');
    }

    public function testHasTitle(): void
    {
        $this->makeComponent([
            'isTitle' => true,
        ])
            ->first('h1 > label')
            ->hasClass('govuk-label--l');
    }

    public function testHasLabelSize(): void
    {
        $this->makeComponent([
            'labelSize' => 'm',
        ])
            ->first('label')
            ->hasClass('govuk-label--m');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.form-group.label', [
            'id' => $data['id'] ?? 'my-id',
            'label' => $data['label'] ?? 'My label',
            'labelSize' => $data['labelSize'] ?? null,
            'isTitle' => $data['isTitle'] ?? false,
        ]);
    }
}

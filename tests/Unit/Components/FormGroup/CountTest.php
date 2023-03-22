<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\FormGroup;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class CountTest extends TestCase
{
    public function testHasCounter(): void
    {
        $this->makeComponent([
            'count' => 12,
        ])
            ->first('div')
            ->hasAttribute('data-maxlength', '12')
            ->contains('My content')
            ->first('div > div')
            ->hasAttribute('id', 'my-id-info');
    }

    public function testHasThreshold(): void
    {
        $this->makeComponent([
            'threshold' => 3,
        ])
            ->first('div')
            ->hasAttribute('data-threshold', '3');
    }

    public function testHasWords(): void
    {
        $this->makeComponent([
            'words' => 12,
        ])
            ->first('div')
            ->hasAttribute('data-maxwords', '12');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.form-group.count', [
            'count' => $data['count'] ?? null,
            'id' => $data['id'] ?? 'my-id',
            'threshold' => $data['threshold'] ?? null,
            'words' => $data['words'] ?? null,
        ]);
    }
}

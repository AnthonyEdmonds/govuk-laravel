<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\FormGroup;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class HintTest extends TestCase
{
    public function testMakesHint(): void
    {
        $this->makeComponent([
            'hint' => 'My hint is juicy',
        ])
            ->first('div')
            ->hasClass('govuk-hint')
            ->hasAttribute('id', 'my-id-hint')
            ->contains('My hint is juicy');
    }

    public function testShowsNothingWhenNoHint(): void
    {
        $this->expectEmptyNodeList();

        $this->makeComponent();
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.form-group.hint', [
            'hint' => $data['hint'] ?? null,
            'id' => $data['id'] ?? 'my-id',
        ]);
    }
}

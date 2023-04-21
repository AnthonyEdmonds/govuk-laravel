<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukComponent;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class TableColumnTest extends TestCase
{
    protected string $json;

    public function testMakesColumnJson(): void
    {
        $this->makeTableColumn()
            ->contains("~~$this->json~~");
    }

    protected function makeTableColumn(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        $this->json = GovukComponent::makeTableColumnJson(
            $data['heading'] ?? false,
            $data['hide'] ?? false,
            $data['label'] ?? '',
            $data['numeric'] ?? false,
            'My content',
        );

        return $this->assertView('govuk::components.table-column', [
            'heading' => $data['heading'] ?? false,
            'hide' => $data['hide'] ?? false,
            'label' => $data['label'] ?? '',
            'numeric' => $data['numeric'] ?? false,
        ]);
    }
}

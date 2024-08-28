<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukComponent;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukComponent;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class RenderTableContentTest extends TestCase
{
    public function testReplacesPlaceholders(): void
    {
        $this->assertEquals(
            'Row 12: My ID is 1, and my name is Bob, 23 years old',
            GovukComponent::renderTableContent(
                $this->makeColumn('Row ~index: My ID is ~id, and my name is ~name, ~age years old'),
                $this->makeRow(1, 'Bob', 23),
                12,
            ),
        );
    }

    public function testHidesColumns(): void
    {
        $this->assertEquals(
            '',
            GovukComponent::renderTableContent(
                $this->makeColumn('My ID is ~id, OK?', '~name'),
                $this->makeRow(1, 'Bob', 23),
            ),
        );
    }

    public function testDoesntHideWhenMissing(): void
    {
        $this->assertEquals(
            'My name is Bob, OK?',
            GovukComponent::renderTableContent(
                $this->makeColumn('My name is ~name, OK?', '~hidden'),
                $this->makeRow(1, 'Bob', 23),
            ),
        );
    }

    public function testSkipsNonScalarValues(): void
    {
        $this->assertEquals(
            'My name is ~name, OK?',
            GovukComponent::renderTableContent(
                $this->makeColumn('My name is ~name, OK?'),
                $this->makeRow(1, ['Goose'], 23),
            ),
        );
    }

    public function testReplacesNullPlaceholders(): void
    {
        $this->assertEquals(
            'My name is , OK?',
            GovukComponent::renderTableContent(
                $this->makeColumn('My name is ~name, OK?'),
                $this->makeRow(1, null, 23),
            ),
        );
    }

    protected function makeColumn(
        string $html,
        ?string $hide = null,
    ): array {
        return [
            'hide' => $hide,
            'html' => $html,
        ];
    }

    protected function makeRow(
        int $id,
        string|array|null $name,
        int $age,
    ): array {
        return [
            'id' => $id,
            'name' => $name,
            'age' => $age,
        ];
    }
}

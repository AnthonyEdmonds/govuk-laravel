<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\Table;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class BodyTest extends TestCase
{
    public function testShowsEmptyWhenNoRows(): void
    {
        $this->makeBody([
            'emptyMessage' => 'My empty message',
            'rows' => [],
        ])
            ->first('tbody > tr > td')
            ->hasAttribute('colspan', '3')
            ->contains('My empty message');
    }

    public function testCreatesRows(): void
    {
        $this->makeBody()
            ->first('tbody')
            ->at('tr', 1)
            ->first('th')
            ->contains('C1, R2');
    }

    public function testCreatesColumns(): void
    {
        $body = $this->makeBody()
            ->first('tbody > tr');

        $body->at('th', 0)
            ->contains('C1, R1');

        $body->at('td', 0)
            ->contains('C2, R1');

        $body->at('td', 1)
            ->hasClass('govuk-table__cell--numeric')
            ->contains('C3, R1');
    }

    protected function makeBody(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.table.body', [
            'columns' => $data['columns'] ?? [
                $this->makeColumn('Column one', '~c1', true),
                $this->makeColumn('Column two', '~c2'),
                $this->makeColumn('Column three', '~c3', false, true),
            ],
            'emptyMessage' => $data['emptyMessage'] ?? null,
            'rows' => $data['rows'] ?? [
                $this->makeRow('C1, R1', 'C2, R1', 'C3, R1'),
                $this->makeRow('C1, R2', 'C2, R2', 'C3, R2'),
            ],
        ]);
    }

    protected function makeColumn(
        string $label,
        string $content,
        bool $heading = false,
        bool $numeric = false,
    ): array {
        return [
            'heading' => $heading,
            'hide' => false,
            'html' => $content,
            'label' => $label,
            'numeric' => $numeric,
        ];
    }

    protected function makeRow(
        string $columnOne,
        string $columnTwo,
        string $columnThree,
    ): array {
        return [
            'c1' => $columnOne,
            'c2' => $columnTwo,
            'c3' => $columnThree,
        ];
    }
}

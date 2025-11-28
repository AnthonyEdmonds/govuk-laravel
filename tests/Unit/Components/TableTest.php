<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukComponent;
use AnthonyEdmonds\GovukLaravel\Tests\Resources\TestJsonResource;
use AnthonyEdmonds\GovukLaravel\Tests\Resources\TestResourceCollection;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Pagination\Paginator;
use InvalidArgumentException;
use NunoMaduro\LaravelMojito\ViewAssertion;

class TableTest extends TestCase
{
    protected array $baseData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->baseData = [
            $this->makeRow(1),
            $this->makeRow(2),
            $this->makeRow(3),
        ];
    }

    public function testProcessesTableColumns(): void
    {
        $table = $this->makeTable();

        $table->first('table > thead > tr')
            ->at('th', 0)
            ->contains('Column one');

        $table->first('table > thead > tr')
            ->at('th', 1)
            ->contains('Column two');

        $table->first('table > thead > tr')
            ->at('th', 2)
            ->contains('Column three');
    }

    public function testDataAcceptsArray(): void
    {
        $this->checkTableData($this->baseData);
    }

    public function testDataAcceptsResourceCollection(): void
    {
        $this->checkTableData(
            new TestResourceCollection([
                new TestJsonResource((object) $this->baseData[0]),
                new TestJsonResource((object) $this->baseData[1]),
                new TestJsonResource((object) $this->baseData[2]),
            ]),
        );
    }

    public function testDataAcceptsJsonResource(): void
    {
        $this->checkTableData(
            new TestJsonResource((object) $this->baseData[0]),
            1,
        );
    }

    public function testDataAcceptsAbstractPaginator(): void
    {
        $this->checkTableData(
            new Paginator($this->baseData, 3, 1),
        );
    }

    public function testDataAcceptsCollection(): void
    {
        $this->checkTableData(collect($this->baseData));
    }

    public function testDataAcceptsOther(): void
    {
        $this->checkTableData((object) $this->baseData);
    }

    public function testHasCaption(): void
    {
        $this->makeTable([
            'captionSize' => 'l',
        ])
            ->first('table > caption')
            ->hasClass('govuk-table__caption--l')
            ->contains('My caption');
    }

    public function testShowsPagination(): void
    {
        $this->makeTable([
            'paginator' => [
                'current_page' => 1,
                'first_page_url' => 'link',
                'from' => 1,
                'next_page_url' => 'link',
                'prev_page_url' => 'link',
                'stacked' => true,
                'to' => 1,
                'total' => 1,
            ],
        ])
            ->has('nav');
    }

    public function testHidesPaginationWhenNull(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The current node list is empty');

        $this->makeTable()
            ->first('body > nav');
    }

    public function testHasId(): void
    {
        $this->makeTable()
            ->hasAttribute('id', 'my-id');
    }

    protected function makeTable(array $data = []): ViewAssertion
    {
        $this->setViewSlot(
            'slot',
            $this->makeTableColumn('Column one', '~c1')
            . $this->makeTableColumn('Column two', '~c2')
            . $this->makeTableColumn('Column three', '~c3'),
        );

        return $this->assertView('govuk::components.table', [
            'caption' => $data['caption'] ?? 'My caption',
            'captionSize' => $data['captionSize'] ?? 'm',
            'data' => $data['data'] ?? null,
            'emptyMessage' => $data['emptyMessage'] ?? 'No results found',
            'id' => $data['id'] ?? 'my-id',
            'paginator' => $data['paginator'] ?? null,
            'showCounter' => $data['showCounter'] ?? false,
        ]);
    }

    protected function makeTableColumn(string $label, string $content): string
    {
        return '~~' . GovukComponent::makeTableColumnJson(
            false,
            null,
            $label,
            false,
            null,
            $content,
        ) . '~~';
    }

    protected function makeRow(int $row): array
    {
        return [
            'c1' => "C1, R$row",
            'c2' => "C2, R$row",
            'c3' => "C3, R$row",
        ];
    }

    protected function checkTableData(mixed $data, int $length = 3): void
    {
        $table = $this->makeTable([
            'data' => $data,
        ])
            ->first('table > tbody');

        $table->at('tr', 0)
            ->contains('C1, R1')
            ->contains('C2, R1')
            ->contains('C3, R1');

        if ($length >= 2) {
            $table->at('tr', 1)
                ->contains('C1, R2')
                ->contains('C2, R2')
                ->contains('C3, R2');
        }

        if ($length >= 3) {
            $table->at('tr', 2)
                ->contains('C1, R3')
                ->contains('C2, R3')
                ->contains('C3, R3');
        }
    }
}

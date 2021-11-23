<?php

namespace AnthonyEdmonds\GovukLaravel\View\Components;

use Closure;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Table extends Component
{
    public array $columns;
    public array $rows;
    public array $pagination;
    
    public function __construct(
        public string $caption,
        public mixed $data,
        public string $emptyMessage = 'No results found',
        public string $captionSize = 'm'
    ) {
        $this->rows = $this->getRows($this->data);
        $this->pagination = $this->getPagination($this->data);
    }

    public function render(): Closure
    {
        return function (array $data): string {
            $this->columns = $this->getColumns($data['slot']);
            
            return '
                <table class="govuk-table">
                    <caption
                        class="govuk-table__caption govuk-table__caption--{{ $captionSize }}"
                    >
                        {{ $caption }}
                    </caption>
                    
                    @dd($data, $rows, $pagination)
                </table>
            ';
        };
    }

    /*
     * <x-govuk::table.header
                        :columns="$columns"
                    />

                    <x-govuk::table.body
                        :columns="$columns"
                        :rows="$rows"
                        :empty-message="$emptyMessage"
                    />
     */
    
    protected function getColumns(string $slot): array
    {
        $columns = [];
        
        while ($start = strpos($slot, '~~')) {
            $end = strpos($slot, '~~', $start + 1);
            $length = $end - $start;

            $columns[] = json_decode(substr($slot, $start + 2, $length - 2), true);
            $slot = substr_replace($slot, '', $start, $length + 2);
        }
        
        return $columns;
    }
    
    protected function getPagination(mixed $data): array
    {
        if ($data instanceof AbstractPaginator === true) {
            return $data->links();
        }
        
        return [];
    }
    
    protected function getRows(mixed $data): array
    {
        if (is_array($data) === true) {
            return $data;
        }
        
        if ($data instanceof ResourceCollection === true) {
            return $data->collection->toArray();
        }
        
        if ($data instanceof Collection === true) {
            return $data->toArray();
        }
        
        return (array)$data;
    }
}

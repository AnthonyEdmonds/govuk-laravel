@props([
    'caption',
    'captionSize' => 'm',
    'data',
    'emptyMessage' => 'No results found',
])

@php
    use Illuminate\Http\Resources\Json\ResourceCollection;
    use Illuminate\Pagination\AbstractPaginator;
    use Illuminate\Support\Collection;

    // Columns
    $columns = [];
            
    while ($start = strpos($slot, '~~')) {
        $end = strpos($slot, '~~', $start + 1);
        $length = $end - $start;

        $columns[] = json_decode(substr($slot, $start + 2, $length - 2), true);
        $slot = substr_replace($slot, '', $start, $length + 2);
    }
    
    // Pagination
    if ($data instanceof AbstractPaginator === true) {
        $pagination = $data->links();
    } else {
        $pagination = [];
    }
    
    // Rows
    if (is_array($data) === true) {
        $rows = $data;
    } elseif ($data instanceof ResourceCollection === true) {
        $rows = $data->collection->toArray();
    } elseif ($data instanceof Collection === true) {
        $rows = $data->toArray();
    } else {
        $rows = (array)$data;        
    }
@endphp

<table class="govuk-table">
    <caption
            class="govuk-table__caption govuk-table__caption--{{ $captionSize }}"
    >
        {{ $caption }}
    </caption>

    @dd($data, $rows, $pagination, $columns)
</table>

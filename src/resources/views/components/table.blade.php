@props([
    'caption',
    'captionSize' => 'm',
    'data',
    'emptyMessage' => 'No results found',
    'id' => null,
    'paginator' => null,
    'showCounter' => false,
])

@php
    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Http\Resources\Json\ResourceCollection;
    use Illuminate\Pagination\AbstractPaginator;
    use Illuminate\Support\Collection;

    // Columns
    $columns = [];
    $html = $slot->toHtml();
    
    while (($start = strpos($html, '~~')) !== false) {
        $end = strpos($html, '~~', $start + 1);
        $length = $end - $start;

        $columns[] = json_decode(substr($html, $start + 2, $length - 2), true);
        $html = substr_replace($html, '', $start, $length + 2);
    }
    
    // Pagination
    if ($data instanceof ResourceCollection === true) {
        $pagination = $data->resource->toArray();
        
        if (isset($pagination['current_page']) === true) {
            $paginator = $pagination;
        }
        
    } elseif ($data instanceof AbstractPaginator === true) {
        $paginator = $data->toArray();
    }
    
    // Rows
    if (is_array($data) === true) {
        $rows = $data;
    } elseif ($data instanceof ResourceCollection === true) {
        $rows = $data->toArray(request());
    } elseif ($data instanceof JsonResource === true) {
        $rows = [$data->toArray(request())];
    } elseif ($data instanceof AbstractPaginator === true) {
        $rows = $data->items();
    } elseif ($data instanceof Collection === true) {
        $rows = $data->toArray();
    } else {
        $rows = (array)$data;        
    }
@endphp

<table
    class="govuk-table"
    @if($id !== null) id="{{ $id }}" @endif
>
    <caption class="govuk-table__caption govuk-table__caption--{{ $captionSize }}">
        {{ $caption }}
    </caption>

    <x-govuk::table.header
        :columns="$columns"
    />

    <x-govuk::table.body
        :columns="$columns"
        :empty-message="$emptyMessage"
        :rows="$rows"
    />
</table>

@if($paginator !== null)
    <x-govuk::pagination
        :label="$caption"
        :paginator="$paginator"
        :show-counter="$showCounter"
    />
@endif

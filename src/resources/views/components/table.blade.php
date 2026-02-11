@props([
    'caption',
    'captionSize' => 'm',
    'data',
    'emptyMessage' => 'No results found',
    'id' => null,
    'marginBottom' => null,
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
    } elseif (
        is_array($data) === true
        && array_key_exists('meta', $data) === true
    ) {
        $paginator = $data['meta'];
    }
    
    // Rows
    if (is_array($data) === true) {
        $rows = array_key_exists('data', $data)
            ? $data['data']
            : $data;
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

     $classes = "govuk-table__caption govuk-table__caption--$captionSize";

    if ($marginBottom !== null) {
        $classes .= " govuk-!-margin-bottom-$marginBottom";
    }

@endphp

<table
    class="govuk-table"
    @if($id !== null) id="{{ $id }}" @endif
>
    <caption class="{{ $classes }}">
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

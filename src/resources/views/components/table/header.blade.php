@props([
    'columns'
])

@php
    $values = array_map(function ($item) {
        return $item->label;
    }, $columns);
@endphp

<thead class="govuk-table__head">
    <x-govuk::table.row
        :columns="$columns"
        :values="$values"
    />
</thead>

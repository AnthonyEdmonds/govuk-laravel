@props([
    'list',
    'noBorders' => false,
])

@php
    $listClasses = 'govuk-summary-list';

    if ($noBorders === true) {
        $listClasses .= ' govuk-summary-list--no-border';
    }
@endphp

<dl class="{{ $listClasses }}">
    @foreach($list as $key => $data)
        <x-govuk::summary-list.item
            :key="$key"
            :value="$data['value'] ?? $data"
            :action="$data['action'] ?? null"
        />
    @endforeach
</dl>

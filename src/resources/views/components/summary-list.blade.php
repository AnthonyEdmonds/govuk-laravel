@props([
    'list',
    'noBorders' => false,
])

@php
    $listClasses = 'govuk-summary-list';
    $mixedList = false;

    if ($noBorders === true) {
        $listClasses .= ' govuk-summary-list--no-border';
    }

    foreach ($list as $item) {
        if (isset($item['action']) === true) {
            $mixedList = true;
            break;
        }
    }
@endphp

<dl class="{{ $listClasses }}">
    @foreach($list as $key => $data)
        <x-govuk::summary-list.item
            :key="$key"
            :value="$data['value'] ?? $data"
            :action="$data['action'] ?? null"
            :mixed-list="$mixedList"
        />
    @endforeach
</dl>

@props([
    'list',
    'noBorders' => false,
    'numeric' => false,
    'widerKey' => false,
])

@php
    $listClasses = 'govuk-summary-list';
    $mixedList = false;

    if ($noBorders === true) {
        $listClasses .= ' govuk-summary-list--no-border';
    }

    if ($numeric === true) {
        $listClasses .= ' govuk-summary-list--numeric';
    }

    if ($widerKey === true) {
        $listClasses .= ' govuk-summary-list--wider-key';
    }

    foreach ($list as $item) {
        if (
            isset($item['action']) === true
            || isset($item['status']) === true
        ) {
            $mixedList = true;
            break;
        }
    }
@endphp

<dl class="{{ $listClasses }}">
    @foreach($list as $key => $data)
        <x-govuk::summary-list.item
            :actions="$data['actions'] ?? null"
            :colour="$data['colour'] ?? null"
            :key="$key"
            :mixed-list="$mixedList"
            :status="$data['status'] ?? null"
            :value="$data['value'] ?? $data"
        />
    @endforeach
</dl>

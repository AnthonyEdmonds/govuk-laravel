@props([
    'list',
    'noBorders' => false,
])

@php
    $defaultAction = null;
    $listClasses = 'govuk-summary-list';
    $mixedList = false;

    if ($noBorders === true) {
        $listClasses .= ' govuk-summary-list--no-border';
    }

    foreach ($list as $item) {
        if (isset($item['action']) === true) {
            $defaultAction = true;
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
                :action="$data['action'] ?? $defaultAction"
                :mixed-list="$mixedList"
        />
    @endforeach
</dl>

@props([
    'colour' => null,
    'column' => [
        'heading' => false,
        'numeric' => false,
    ],
    'colspan' => 1,
    'rowspan' => 1,
])

@php
    $tag = $column['heading'] === true ? 'th' : 'td';
    $type = $column['heading'] === true ? 'header' : 'cell';
    $cellClasses = "govuk-table__{$type}";
    
    if ($column['numeric'] == true) {
        $cellClasses .= " govuk-table__{$type}--numeric";
    }

    if ($colour !== null) {
        $cellClasses .= " app-!-font-govuk-{$colour}";
    }
@endphp

<{{ $tag }}
    class="{{ $cellClasses }}"
    colspan="{{ $colspan }}"
    rowspan="{{ $rowspan }}"
>
    {{ $slot }}
</{{ $tag }}>

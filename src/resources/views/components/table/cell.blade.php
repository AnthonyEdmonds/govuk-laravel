@props([
    'colour' => null,
    'colspan' => 1,
    'heading' => false,
    'numeric' => false,
    'rowspan' => 1,
])

@php
    $tag = $heading === true ? 'th' : 'td';
    $type = $heading === true ? 'header' : 'cell';
    $cellClasses = "govuk-table__{$type}";
    
    if ($numeric == true) {
        $cellClasses .= " govuk-table__{$type}--numeric";
    }

    if ($colour !== null) {
        $cellClasses .= " app-!-font-{$colour}";
    }
@endphp

<{{ $tag }}
    class="{{ $cellClasses }}"
    colspan="{{ $colspan }}"
    rowspan="{{ $rowspan }}"
>
    {{ $slot }}
</{{ $tag }}>

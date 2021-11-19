@props([
    'colour' => null,
    'colspan' => null,
    'numeric' => false,
])

@php
    $cellClass = 'govuk-table__cell';

    if ($numeric == true) {
        $cellClass .= ' govuk-table__cell--numeric';
    }

    if ($colour !== null) {
        $cellClass .= " app-!-font-govuk-{$colour}";
    }
@endphp

<td
    class="{{ $cellClass }}"
    @if($colspan !== null) colspan="{{ $colspan }}" @endif
>
    {!! $slot !!}
</td>

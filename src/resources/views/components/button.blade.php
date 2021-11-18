@props([
    'asLink' => false,
    'disabled' => false,
    'preventDoubleClick' => false,
    'secondary' => false,
    'start' => false,
    'warning' => false,
])

@php
    $classes = 'govuk-button';

    if ($disabled === true) {
        $classes .= ' govuk-button--disabled';
    }

    if ($secondary === true) {
        $classes .= ' govuk-button--secondary';
    }

    if ($start === true) {
        $classes .= ' govuk-button--start';
    }

    if ($warning === true) {
        $classes .= ' govuk-button--warning';
    }

    if ($asLink === true) {
        $classes .= ' app-button--as-link';
    }
@endphp

<button
    class="{{ $classes }}"
    data-module="govuk-button"

    @if($disabled === true)
        aria-disabled="true"
        disabled
    @endif

    @if($preventDoubleClick === true)
        data-prevent-double-click="true"
    @endif
>
    {{ $slot }}
</button>

@props([
    'id' => null,
    'marginBottom' => null,
    'size' => 's'
])

@php
    $classes = "govuk-heading-$size";

    if ($marginBottom !== null) {
        $classes .= " govuk-!-margin-bottom-$marginBottom";
    }
@endphp

<h3
    class="{{ $classes }}"
    @if($id !== null) id="{{ $id }}" @endif
>{{ $slot }}</h3>

@props([
    'id' => null,
    'marginBottom' => null,
    'size' => 'm'
])

@php
    $classes = "govuk-heading-$size";

    if ($marginBottom !== null) {
        $classes .= " govuk-!-margin-bottom-$marginBottom";
    }
@endphp

<h2
    class="{{ $classes }}"
    @if($id !== null) id="{{ $id }}" @endif
>{{ $slot }}</h2>

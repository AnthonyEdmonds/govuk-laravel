@props([
    'id' => null,
    'marginBottom' => null,
    'size' => 'l',
])

@php

    $classes = "govuk-heading-$size";
    if ($marginBottom !== null) {
        $classes .= " govuk-!-margin-bottom-$marginBottom";
    }

@endphp

<h1
    class="{{ $classes }} "
    @if($id !== null) id="{{ $id }}" @endif
>{{ $slot }}</h1>

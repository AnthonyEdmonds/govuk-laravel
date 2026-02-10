@props([
    'id' => null,
    'size' => 'l',
    'marginBottom' => null
])

@php
    $classes = "govuk-heading-$size";
    if ($marginBottom !== null) {
        $classes .=  " govuk-!-margin-bottom-$marginBottom";
    }
@endphp

<h1
    class="{{$classes}} "
    @if($id !== null) id="{{ $id }}" @endif
>{{ $slot }}</h1>

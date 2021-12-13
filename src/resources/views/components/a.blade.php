@props([
    'asButton' => false,
    'href',
    'target' => '_self',
])

@php
    $linkClasses = $asButton === true
        ? 'govuk-button'
        : 'govuk-link';
@endphp

<a
    class="{{ $linkClasses }}"
    href="{{ $href }}"
    target="{{ $target }}"
>{{ $slot }}</a>

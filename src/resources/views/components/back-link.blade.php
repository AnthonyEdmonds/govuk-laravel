@props([
    'href',
    'inverted' => false,
])

@php
    $classes = 'govuk-back-link';
    
    if ($inverted === true) {
        $classes .= ' govuk-back-link--inverse';
    }
@endphp

<a href="{{ $href }}" class="{{ $classes }}">Back</a>

@props([
    'asButton' => false,
    'footer' => false,
    'href',
    'target' => '_self',
])

@php
    if ($footer === true) {
        $linkClasses = 'govuk-footer__link';
    } else {
        $linkClasses = $asButton === true
            ? 'govuk-button'
            : 'govuk-link';
    }
@endphp

<a
    class="{{ $linkClasses }}"
    href="{{ $href }}"
    target="{{ $target }}"
>{{ $slot }}</a>

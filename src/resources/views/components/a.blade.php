@props([
    'href',
    'target' => '_self',
])

<a
    class="govuk-link"
    href="{{ $href }}"
    target="{{ $target }}"
>{{ $slot }}</a>

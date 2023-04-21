@props([
    'id' => uniqid(),
    'rememberExpanded' => true,
])

@php
    $remember = $rememberExpanded === true
        ? 'true'
        : 'false';
@endphp

<div
    class="govuk-accordion"
    data-module="govuk-accordion"
    data-remember-expanded="{{ $remember }}"
    id="accordion-{{ $id }}"
>
    {{ $slot }}
</div>

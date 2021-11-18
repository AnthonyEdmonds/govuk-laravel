@props([
    'width'
])

<div class="govuk-grid-column-{{ $width }}">
    {{ $slot }}
</div>

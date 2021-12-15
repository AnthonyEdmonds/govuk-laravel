@props([
    'id',
    'label',
])

<div class="govuk-tabs__panel" id="{{ $id }}">
    ~~{{ $id }}|{{ $label }}~~
    {{ $slot }}
</div>

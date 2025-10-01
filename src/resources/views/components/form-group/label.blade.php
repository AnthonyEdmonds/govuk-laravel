@props([
    'id',
    'label',
    'labelSize' => null,
    'isTitle' => false,
])

@php
    if ($labelSize === null) {
        $labelSize = $isTitle === true
            ? 'l'
            : 's';
    }
@endphp

@if($isTitle === true)
    <h1 class="govuk-label-wrapper">
@endif

<label class="govuk-label govuk-label--{{ $labelSize }}" for="{{ $id }}">
    {{ $label }}
</label>

@if($isTitle === true)
    </h1>
@endif

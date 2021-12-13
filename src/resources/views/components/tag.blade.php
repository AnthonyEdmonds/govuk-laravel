@props([
    'colour' => 'blue',
    'label',
    'phase' => false,
])

@php
    $tagClasses = "govuk-tag govuk-tag--{$colour}";

    if ($phase === true) {
        $tagClasses .= ' govuk-phase-banner__content__tag';
    }
@endphp

<strong class="{{ $tagClasses }}">
    {{ $label }}
</strong>

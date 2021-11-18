@props([
    'colour' => 'blue',
    'tag',
    'phase' => false,
])

@php
    $tagClasses = "govuk-tag govuk-tag--{$colour}";

    if ($phase === true) {
        $tagClasses .= ' govuk-phase-banner__content__tag';
    }
@endphp

<strong class="{{ $tagClasses }}">
    {{ $tag }}
</strong>

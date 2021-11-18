@props([
    'size' => 'xl',
    'visible' => false,
])

@php
    $breakClasses = 'govuk-section-break';

    if ($size !== null) {
        $breakClasses .= " govuk-section-break--{$size}";
    }

    if ($visible === true) {
        $breakClasses .= ' govuk-section-break--visible';
    }
@endphp

<hr class="{{ $breakClasses }}" />

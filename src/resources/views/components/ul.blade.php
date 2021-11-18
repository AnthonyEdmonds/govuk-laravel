@props([
    'bullet' => false,
    'spaced' => false,
])

@php
    $listClasses = 'govuk-list';

    if ($bullet === true) {
        $listClasses .= ' govuk-list--bullet';
    }

    if ($spaced === true) {
        $listClasses .= ' govuk-list--spaced';
    }
@endphp

<ul class="{{ $listClasses }}">
    {!! $slot !!}
</ul>

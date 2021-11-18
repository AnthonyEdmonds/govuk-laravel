@props([
    'bulleted' => false,
    'spaced' => false,
])

@php
    $listClasses = 'govuk-list';

    if ($bulleted === true) {
        $listClasses .= ' govuk-list--bullet';
    }

    if ($spaced === true) {
        $listClasses .= ' govuk-list--spaced';
    }
@endphp

<ul class="{{ $listClasses }}">
    {!! $slot !!}
</ul>

@props([
    'bulleted' => false,
    'spaced' => false,
    'type' => 'bullet',
])

@php
    $listClasses = 'govuk-list';

    if ($bulleted === true) {
        $listClasses .= " govuk-list--$type";
    }

    if ($spaced === true) {
        $listClasses .= ' govuk-list--spaced';
    }
@endphp

<ul class="{{ $listClasses }}">
    {!! $slot !!}
</ul>

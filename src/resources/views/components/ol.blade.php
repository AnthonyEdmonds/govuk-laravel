@props([
    'spaced' => false,
])

@php
    $listClasses = 'govuk-list govuk-list--number';

    if ($spaced === true) {
        $listClasses .= ' govuk-list--spaced';
    }
@endphp

<ol class="{{ $listClasses }}">
    {!! $slot !!}
</ol>

@props([
    'spaced' => false,
    'type' => 'number',
])

@php
    $listClasses = "govuk-list govuk-list--$type";

    if ($spaced === true) {
        $listClasses .= ' govuk-list--spaced';
    }
@endphp

<ol class="{{ $listClasses }}">
    {!! $slot !!}
</ol>

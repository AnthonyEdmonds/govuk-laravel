@props([
    'name',
])

@php
    $groupClasses = 'govuk-form-group';

    if ($errors->has($name) === true) {
        $groupClasses .= ' govuk-form-group--error';
    }
@endphp

<div class="{{ $groupClasses }}">
    {!! $slot !!}
</div>

@props([
    'name',
])

@php
    $groupClasses = 'govuk-form-group';

    if ($errors->has(\AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion::bracketsToDots($name)) === true) {
        $groupClasses .= ' govuk-form-group--error';
    }
@endphp

<div class="{{ $groupClasses }}">
    {!! $slot !!}
</div>

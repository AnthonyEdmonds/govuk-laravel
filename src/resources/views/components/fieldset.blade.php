@props([
    'id',
    'isTitle' => true,
    'label',
    'labelSize' => null,
])

@php
    if ($labelSize === null) {
        $labelSize = $isTitle === true
            ? 'l'
            : 's';
    }
@endphp

<fieldset
    class="govuk-fieldset"
    aria-describedby="{{ $id }}-hint"
>
    <legend class="govuk-fieldset__legend govuk-fieldset__legend--{{ $labelSize }}">
        @if($isTitle === true)
            <h1 class="govuk-fieldset__heading">
        @endif
                
            {{ $label }}
                
        @if($isTitle === true)
            </h1>
        @endif
    </legend>

    {!! $slot !!}
</fieldset>

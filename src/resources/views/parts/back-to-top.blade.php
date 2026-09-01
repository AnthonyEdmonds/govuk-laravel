@php
    $label = config('govuk.parts.back_to_top');
@endphp

@if($label !== null)
    <x-govuk::p>
        <x-govuk::a href="#">{{ $label }}</x-govuk::a>
    </x-govuk::p>
@endif

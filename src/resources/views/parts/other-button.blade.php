@php
    use AnthonyEdmonds\GovukLaravel\Pages\Page;
@endphp

@if($otherButtonHref !== null)
    @if($otherButtonMethod !== null && $otherButtonMethod !== Page::GET_METHOD)
        <x-govuk::button
                as-link
                form-action="{{$otherButtonHref}}"
                form-method="{{$otherButtonMethod}}"
        >{{ $otherButtonLabel }}</x-govuk::button>
    @else
        <x-govuk::a href="{{ $otherButtonHref }}">{{ $otherButtonLabel }}</x-govuk::a>
    @endif
@endif

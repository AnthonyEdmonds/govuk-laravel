@extends('govuk::layout.page')

@php
    use AnthonyEdmonds\GovukLaravel\Pages\Page;
@endphp

@section('main')
    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        @foreach($questions as $question)
            {!! $question->toBlade() !!}
        @endforeach

        <x-govuk::button-group>
            <x-govuk::button :type="$submitButtonType">
                {{ $submitButtonLabel }}
            </x-govuk::button>
            
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
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

@extends('govuk::layout.page')

@section('main')
    <x-govuk::summary-list :list="$summary" />

    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        <x-govuk::button-group>
            <x-govuk::button :type="$submitButtonType">
                {{ $submitButtonLabel }}
            </x-govuk::button>
            
            @if($otherButtonHref !== null)
                <x-govuk::a href="{{ $otherButtonHref }}">{{ $otherButtonLabel }}</x-govuk::a>
            @endif
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

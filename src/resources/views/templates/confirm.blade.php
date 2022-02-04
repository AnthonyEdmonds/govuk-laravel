@extends('govuk::layout.page')

@section('main')
    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        <x-govuk::button-group>
            <x-govuk::button :type="$submitButtonType">
                {{ $submitButtonLabel }}
            </x-govuk::button>

            <x-govuk::a href="{{ $otherButtonHref }}">{{ $otherButtonLabel }}</x-govuk::a>
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

@extends('govuk::layout.page')

@section('main')
    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        <x-govuk::button-group>
            <x-govuk::button :type="$buttonType">
                {{ $buttonLabel }}
            </x-govuk::button>

            <x-govuk::a href="{{ $back }}">{{ $cancelLabel }}</x-govuk::a>
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

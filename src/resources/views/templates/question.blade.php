@extends('govuk::layout.page')

@section('main')
    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        @foreach($questions as $question)
            <x-govuk::question :settings="$question" />
        @endforeach

        <x-govuk::button-group>
            <x-govuk::button :mode="$submitButtonMode" prevent-double-click>
                {{ $submitButtonLabel }}
            </x-govuk::button>
            
            @include('govuk::parts.other-button')
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

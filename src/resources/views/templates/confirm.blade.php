@extends('govuk::layout.page')

@section('content')
    @if($content !== null)
        @include($content)
    @endif

    <x-govuk::section-break />

    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        <x-govuk::button-group>
            <x-govuk::button :type="$buttonType">
                {{ $buttonLabel }}
            </x-govuk::button>

            <x-govuk::a href="{{ $back }}">Cancel and back</x-govuk::a>
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

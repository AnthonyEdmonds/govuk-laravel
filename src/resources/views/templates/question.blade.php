@extends('govuk::layout.page')

@section('content')
    @include('govuk::parts.content')

    <x-govuk::section-break />

    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        {{ $question->toBlade() }}
        
        <x-govuk::button :type="$buttonType">
            {{ $buttonLabel }}
        </x-govuk::button>
    </x-govuk::form>
@endsection

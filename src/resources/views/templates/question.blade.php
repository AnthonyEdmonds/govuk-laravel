@extends('govuk::layout.page')

@section('content')
    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        {!! $question->toBlade() !!}
        
        <x-govuk::button :type="$buttonType">
            {{ $buttonLabel }}
        </x-govuk::button>
    </x-govuk::form>

    <x-govuk::section-break />
    @include('govuk::parts.content')
@endsection

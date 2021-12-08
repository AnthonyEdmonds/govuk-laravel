@extends('govuk::layout.page')

@section('content')
    @if($hideTitle === false)
        @include('govuk::parts.content')
        <x-govuk::section-break />
    @endif
    
    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        @foreach($questions as $question)
            {!! $question->toBlade() !!}
        @endforeach
        
        <x-govuk::button :type="$buttonType">
            {{ $buttonLabel }}
        </x-govuk::button>
    </x-govuk::form>

    @if($hideTitle === true)
        <x-govuk::section-break />
        @include('govuk::parts.content')
    @endif
@endsection

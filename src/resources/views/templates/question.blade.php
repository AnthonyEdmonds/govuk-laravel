@extends('govuk::layout.page')

@section('main')
    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        @foreach($questions as $question)
            {!! $question->toBlade() !!}
        @endforeach
        
        <x-govuk::button-group>
            <x-govuk::button :type="$buttonType">
                {{ $buttonLabel }}
            </x-govuk::button>
            
            @yield('buttons')
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

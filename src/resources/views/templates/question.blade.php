@extends('govuk::layout.page')

@section('main')
    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        @foreach($questions as $question)
            {!! $question->toBlade() !!}
        @endforeach

        <x-govuk::button-group>
            <x-govuk::button :type="$submitButtonType">
                {{ $submitButtonLabel }}
            </x-govuk::button>
            
            <!-- TODO Allow other methods from this based on otherButtonMethod -->
            @if($otherButtonHref !== null)
                <x-govuk::a href="{{ $otherButtonHref }}">{{ $otherButtonLabel }}</x-govuk::a>
            @endif
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

@extends('govuk::layout.page')

@section('main')
    <x-govuk::form
        :action="$action"
        :method="$method"
    >
        <x-govuk::button-group>
            <x-govuk::button
                as-start-button
                prevent-double-click
            >{{ $submitButtonLabel }}</x-govuk::button>

            @isset($isInProgress)
                @if($isInProgress === true)
                    <x-govuk::button
                        form-action="{{ $summaryRoute }}"
                        prevent-double-click
                    >Resume previous session</x-govuk::button>
                @endif
            @endisset
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

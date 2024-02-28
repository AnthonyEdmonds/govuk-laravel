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
                        form-method="{{ \AnthonyEdmonds\GovukLaravel\Pages\Page::GET_METHOD }}"
                        prevent-double-click
                        secondary
                    >Resume previous session</x-govuk::button>
                @endif
            @endisset
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

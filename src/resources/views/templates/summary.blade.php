@extends('govuk::layout.page')

@section('main')
    <x-govuk::summary-list :list="$summary" />

    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        <x-govuk::button-group>
            <x-govuk::button :mode="$submitButtonMode" prevent-double-click>
                {{ $submitButtonLabel }}
            </x-govuk::button>
            
            @isset($draftButtonLabel)
                <x-govuk::button secondary prevent-double-click :form-action="$draftButtonAction">
                    {{ $draftButtonLabel }}
                </x-govuk::button>
            @endif

            @include('govuk::parts.other-button')
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

@extends('govuk::layout.page')

@section('main')
    <x-govuk::form
        :action="$action"
        :method="$method"
    >
        <x-govuk::button as-start-button prevent-double-click>{{ $submitButtonLabel }}</x-govuk::button>
    </x-govuk::form>
@endsection

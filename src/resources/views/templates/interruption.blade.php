@extends('govuk::layout.page')

@section('main')
    <x-govuk::panel
        interruption
        :title="$title"
        :confirmLabel="$confirmLabel"
        :confirmUrl="$confirmUrl"
        :cancelLabel="$cancelLabel"
        :cancelUrl="$cancelUrl"
    >
        @yield('panel-body')
    </x-govuk::panel>
@endsection

@extends('govuk::layout.page')

@section('main')
    <x-govuk::panel :title="$title">
        @yield('panel-body')
    </x-govuk::panel>
@endsection

@extends('govuk::layout.page')

@section('main')
    <x-govuk::a as-start-button :href="$action">{{ $submitButtonLabel }}</x-govuk::a>
@endsection

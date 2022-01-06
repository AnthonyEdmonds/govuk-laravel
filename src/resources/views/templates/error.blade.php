@extends('govuk::layout.page')

@section('before-main')
    @isset($exception)
        <x-govuk::h2>{{ $exception->getMessage() }}</x-govuk::h2>
    @endisset
@endsection

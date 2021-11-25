@extends('govuk::layout.page')

@section('content')
    @isset($exception)
        <x-govuk::h2>{{ $exception->getMessage() }}</x-govuk::h2>
    @endisset
@endsection

@include('govuk::parts.content')

@extends('govuk::layout.page')

@section('content')
    @isset($exception)
        <x-govuk::h2>{{ $exception->getMessage() }}</x-govuk::h2>
    @endisset
    
    @yield('help')
    @include('govuk::parts.content')
@endsection

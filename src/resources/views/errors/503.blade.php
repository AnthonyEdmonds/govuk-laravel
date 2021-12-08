@extends('govuk::templates.error', [
    'back' => back()->getTargetUrl(),
    'title' => 'Sorry, the system is unavailable',
])

@section('main')
    <x-govuk::p>The system may have been taken down for scheduled maintenance.</x-govuk::p>
    <x-govuk::p>Please try again later.</x-govuk::p>
@endsection

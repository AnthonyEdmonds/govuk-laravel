@extends('govuk::templates.error', [
    'back' => back()->getTargetUrl(),
    'title' => 'Sorry, there is a problem with the system',
])

@section('main')
    <x-govuk::p>Try again later.</x-govuk::p>
    <x-govuk::p>If you were in the middle of submitting a form, your answers should be available for the next few days.</x-govuk::p>
@endsection

@extends('errors.support', [
    'back' => back()->getTargetUrl(),
    'title' => 'Sorry, there is a problem with the system',
])

@section('content')
    <x-govuk::p>Try again later.</x-govuk::p>
    <x-govuk::p>If you were in the middle of submitting a form, your answers should be available for the next few days.</x-govuk::p>
@endsection

@extends('govuk::templates.error', [
    'back' => back()->getTargetUrl(),
    'title' => 'Too many requests',
])

@section('main')
    <x-govuk::p>If you have recently submitted a lot of forms, wait a few minutes and try again.</x-govuk::p>
    <x-govuk::p>If you are using a tool to automatically complete forms, lower the rate at which it makes requests.</x-govuk::p>
@endsection

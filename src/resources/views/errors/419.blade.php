@extends('govuk::templates.error', [
    'back' => back()->getTargetUrl(),
    'title' => 'Page expired',
])

@section('main')
    <x-govuk::p>If you left the page open or your computer idle for a while, go back, refresh the page, and try again.</x-govuk::p>
@endsection

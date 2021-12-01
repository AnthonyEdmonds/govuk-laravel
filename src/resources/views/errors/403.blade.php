@extends('govuk::templates.error', [
    'back' => back()->getTargetUrl(),
    'title' => 'Forbidden'
])

@section('content')
    <x-govuk::p>The last action you attempted is not allowed.</x-govuk::p>
@endsection

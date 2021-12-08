@extends('govuk::templates.error', [
    'back' => back()->getTargetUrl(),
    'title' => 'Unauthorised',
])

@section('main')
    <x-govuk::p>You may not have the right to access this page.</x-govuk::p>
    <x-govuk::p>
        If you believe you should have access to this page, <x-govuk::a href="{{ route('sign-out') }}">sign out</x-govuk::a>, sign back in, and try again.
    </x-govuk::p>
@endsection

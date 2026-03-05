@extends('govuk::templates.error', [
    'back' => back()->getTargetUrl(),
    'title' => 'Unauthorised',
])

@section('main')
    <x-govuk::p>You may not have the right to access this page.</x-govuk::p>
    <x-govuk::p>
        If you believe you should have access to this page, <x-govuk::a href="{{ config('govuk.support_link') }}">contact support</x-govuk::a>.
    </x-govuk::p>
@endsection

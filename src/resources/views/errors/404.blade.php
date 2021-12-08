@extends('govuk::templates.error', [
    'back' => back()->getTargetUrl(),
    'title' => 'Page not found',
])

@section('main')
    <x-govuk::p>If you typed the web address, check that it is correct.</x-govuk::p>
    <x-govuk::p>If you pasted the web address, check that you copied the entire address.</x-govuk::p>
    <x-govuk::p>If you followed a link from an e-mail or your browsing history, try navigating to the page manually.</x-govuk::p>
    <x-govuk::p>If the address is correct, or you selected a link or button from within this system, let us know</x-govuk::p>
@endsection

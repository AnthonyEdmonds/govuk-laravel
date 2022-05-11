@extends('govuk::layout.page')

@section('main')
    <x-govuk::button :type="$submitButtonType" :href="$submitButtonHref">
        {{ $submitButtonLabel }}
    </x-govuk::button>
@endsection

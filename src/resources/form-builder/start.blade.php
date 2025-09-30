@extends('govuk::layout.page')

@section('before-main')
    @foreach($description as $line)
        <x-govuk::p>{{ $line }}</x-govuk::p>
    @endforeach
@endsection

@section('main')
    <x-govuk::button-group>
        <x-govuk::a
            as-start-button
            href="{{ $actions['start']->link }}"
        >{{ $actions['start']->label }}</x-govuk::a>

        <x-govuk::a href="{{ $actions['exit']->link }}">{{ $actions['exit']->label }}</x-govuk::button>
    </x-govuk::button-group>
@endsection

@extends('govuk::layout.page')

@section('main')
    @foreach($description as $line)
        <x-govuk::p>{{ $line }}</x-govuk::p>
    @endforeach

    <x-govuk::button-group>
        <x-govuk::a
                as-button
                href="{{ $actions['resume']->link }}"
        >{{ $actions['resume']->label }}</x-govuk::a>

        <x-govuk::a
                as-button
                secondary
                href="{{ $actions['restart']->link }}"
        >{{ $actions['restart']->label }}</x-govuk::button>

        <x-govuk::a href="{{ $actions['exit']->link }}">{{ $actions['exit']->label }}</x-govuk::button>
    </x-govuk::button-group>
@endsection

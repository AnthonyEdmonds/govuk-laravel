@extends('govuk::layout.page')

@section('before-main')
    @foreach ($description as $line)
        <x-govuk::p>{{ $line }}</x-govuk::p>
    @endforeach
@endsection

@section('main')
    <x-govuk::task-list :tasks="$tasks" />

    @isset($draft)
        <x-govuk::form action="">
            @endisset

            <x-govuk::button-group>
                <x-govuk::a
                        as-button
                        href="{{ $actions['summary']->link }}"
                >{{ $actions['summary']->label }}</x-govuk::a>

                @isset($draft)
                    <x-govuk::button
                            form-action="{{ $draft->link }}"
                            secondary
                    >{{ $draft->label }}</x-govuk::button>
                @endisset

                <x-govuk::a
                        href="{{ $actions['exit']->link }}"
                >{{ $actions['exit']->label }}</x-govuk::button>
            </x-govuk::button-group>

            @isset($draft)
        </x-govuk::form>
    @endisset
@endsection

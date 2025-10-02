@extends('govuk::layout.page')

@section('main')
    <x-govuk::form action="{{ $save->link }}">
        @forelse($fields as $field)
            <x-govuk::question :settings="$field->toArray()" />
        @empty
            <p>No fields have been added to this question.</p>
        @endforelse

        <x-govuk::button-group>
            <x-govuk::button prevent-double-click>{{ $save->label }}</x-govuk::button>

            @isset($skip)
                <x-govuk::button
                    form-action="{{ $skip->link }}"
                    secondary
                >{{ $skip->label }}</x-govuk::button>
            @endisset

            @if($actions['back']->link !== $actions['task']->link)
                <x-govuk::a
                    href="{{ $actions['back']->link }}"
                >{{ $actions['back']->label }}</x-govuk::button>
            @endif

            <x-govuk::a
                href="{{ $actions['task']->link }}"
            >{{ $actions['task']->label }}</x-govuk::button>
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

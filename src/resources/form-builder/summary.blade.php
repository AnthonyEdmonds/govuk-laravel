@extends('govuk::layout.page')

@section('before-main')
    @foreach($description as $line)
        <x-govuk::p>{{ $line }}</x-govuk::p>
    @endforeach
@endsection

@section('main')
    @forelse($summary as $task)
        <x-govuk::summary-card
            :actions="$task['actions']"
            :list="$task['list']"
            :status="$task['status']"
            :status-colour="$task['colour']"
            :title="$task['title']"
        />
    @empty
        <p>No tasks have been added to this form.</p>
    @endforelse

    <x-govuk::form action="{{ $submit->link }}">
        <x-govuk::button-group>
            <x-govuk::button prevent-double-click>{{ $submit->label }}</x-govuk::button>

            @isset($draft)
                <x-govuk::button
                    :form-action="$draft->link"
                    prevent-double-click
                    secondary
                >
                    {{ $draft->label }}
                </x-govuk::button>
            @endif

            <x-govuk::a
                href="{{ $actions['back']->link }}"
            >{{ $actions['back']->label }}</x-govuk::button>

            <x-govuk::a
                href="{{ $actions['exit']->link }}"
            >{{ $actions['exit']->label }}</x-govuk::button>
        </x-govuk::button-group>
    </x-govuk::form>
@endsection

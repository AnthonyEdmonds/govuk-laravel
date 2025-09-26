@extends('govuk::layout.page')

@section('main')
    @forelse($summary as $task)
        <x-govuk::summary-card
            :list="$task['list']"
            :title="$task['title']"
        />
    @empty
        <p>No tasks have been added to this form.</p>
    @endforelse

    <x-govuk::p>
        <x-govuk::a href="{{ $edit->link }}">{{ $edit->label }}</x-govuk::a>
    </x-govuk::p>
@endsection

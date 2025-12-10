@extends('govuk::layout.page')
@use(Illuminate\Support\Facades\View)

@php
    $hasActions = View::hasSection('actions') === true;
    $hasEdit = isset($edit) === true;
@endphp

@section('before-main')
    @if($hasActions === true || $hasEdit === true)
        <x-govuk::h2>{{ $actionsLabel ?? 'Actions' }}</x-govuk::h2>

        @if($hasActions === true)
            @yield('actions')
        @elseif($hasEdit === true)
            <x-govuk::ul spaced>
                <li>
                    <x-govuk::a href="{{ $edit->link }}">{{ $edit->label }}</x-govuk::a>
                </li>
            </x-govuk::ul>
        @endif
    @endif
@endsection

@section('main')
    <x-govuk::h2>{{ $detailsLabel ?? 'Details' }}</x-govuk::h2>

    @forelse($summary as $task)
        <x-govuk::summary-card
            :list="$task['list']"
            :title="$task['title']"
        />
    @empty
        <p>No tasks have been added to this form.</p>
    @endforelse
@endsection

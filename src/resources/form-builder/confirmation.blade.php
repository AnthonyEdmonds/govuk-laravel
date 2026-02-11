@extends('govuk::layout.page')

@section('main')
    <x-govuk::panel
        :title="$title"
    >
        Your reference number is
        <br/><strong>#{{ $model->getKey() }}</strong>
    </x-govuk::panel>

    @foreach($description as $line)
        <x-govuk::p>{{ $line }}</x-govuk::p>
    @endforeach

    <x-govuk::h2>What would you like to do now?</x-govuk::h2>
    <x-govuk::ul spaced>
        <li>
            <a href="{{ $actions['view']->link }}">{{ $actions['view']->label }}</a>
        </li>
        <li>
            <a href="{{ $actions['restart']->link }}">{{ $actions['restart']->label }}</a>
        </li>
        <li>
            <a href="{{ $actions['exit']->link }}">{{ $actions['exit']->label }}</a>
        </li>
    </x-govuk::ul>
@endsection

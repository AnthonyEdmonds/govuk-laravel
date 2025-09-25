@props([
    'asButton' => false,
    'hidden' => null,
    'label',
    'method' => 'post',
    'url',
])

@if($asButton === true)
    <x-govuk::form :action="$url" :method="$method">
        <x-govuk::button as-link>
            {{ $label }}
            @isset($hidden)
                <x-govuk::hidden>{{ $hidden }}</x-govuk::hidden>
            @endisset
        </x-govuk::button>
    </x-govuk::form>
@else
    <x-govuk::a href="{{ $url }}">
        {{ $label }}
        @isset($hidden)
            <x-govuk::hidden>{{ $hidden }}</x-govuk::hidden>
        @endisset
    </x-govuk::a>
@endif

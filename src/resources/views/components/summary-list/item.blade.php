@props([
    'key',
    'value',
    'action' => null,
])

@php
    if (is_array($value) !== true) {
        $value = [$value];
    }
@endphp

<div class="govuk-summary-list__row">
    <dt class="govuk-summary-list__key">
        {{ $key }}
    </dt>
    
    <dd class="govuk-summary-list__value">
        @foreach($value as $entry)
            <x-govuk::p>{{ $entry }}</x-govuk::p>
        @endforeach
    </dd>
    
    @isset($action)
        <dd class="govuk-summary-list__actions">
            <x-govuk::a href="{{ $action['url'] }}">
                {{ $action['label'] }}
                @isset($action['hidden'])
                    <x-govuk::hidden>{{ $action['hidden'] }}</x-govuk::hidden>
                @endisset
            </x-govuk::a>
        </dd>
    @endisset
</div>

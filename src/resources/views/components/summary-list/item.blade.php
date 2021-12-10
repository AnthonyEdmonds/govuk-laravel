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
            <a class="govuk-link" href="#">
                Change<span class="govuk-visually-hidden"> name</span>
            </a>
        </dd>
    @endisset
</div>

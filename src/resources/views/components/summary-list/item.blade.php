@props([
    'key',
    'value',
    'action' => null,
    'mixedList' => false,
])

@php
    if (is_array($value) !== true) {
        $value = [$value];
    }

    $rowClasses = 'govuk-summary-list__row';

    if ($mixedList === true && $action === null) {
        $rowClasses .= ' govuk-summary-list__row--no-actions';
    }

    $asButton = $action['asButton'] ?? false;
@endphp

<div class="{{ $rowClasses }}">
    <dt class="govuk-summary-list__key">{!! $key !!}</dt>

    <dd class="govuk-summary-list__value">
        @foreach($value as $entry)
            <x-govuk::p>{!! $entry !!}</x-govuk::p>
        @endforeach
    </dd>

    @if ($action !== null)
        <dd class="govuk-summary-list__actions">
            @if ($asButton === true)
                <x-govuk::form :action="$action['url']" :method="$action['method'] ?? 'post'">
                    <x-govuk::button as-link>
                        {{ $action['label'] }}
                        @isset($action['hidden'])
                            <x-govuk::hidden>{{ $action['hidden'] }}</x-govuk::hidden>
                        @endisset
                    </x-govuk::button>
                </x-govuk::form>
            @else
                <x-govuk::a href="{{ $action['url'] }}">
                    {{ $action['label'] }}
                    @isset($action['hidden'])
                        <x-govuk::hidden>{{ $action['hidden'] }}</x-govuk::hidden>
                    @endisset
                </x-govuk::a>
            @endif
        </dd>
    @endif
</div>

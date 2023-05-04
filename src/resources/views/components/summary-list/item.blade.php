@props([
    'key',
    'value',
    'action' => null,
])

@php
    if (is_array($value) !== true) {
        $value = [$value];
    }

    $rowClasses = $action !== null
        ? 'govuk-summary-list__row'
        : 'govuk-summary-list__row govuk-summary-list__row--no-actions';
@endphp

<div class="{{ $rowClasses }}">
    <dt class="govuk-summary-list__key">
        {!! $key !!}
    </dt>
    
    <dd class="govuk-summary-list__value">
        @foreach($value as $entry)
            <x-govuk::p>{!! $entry !!}</x-govuk::p>
        @endforeach
    </dd>
    
    @isset($action)
        <dd class="govuk-summary-list__actions">
            @if ($action !== true)
                @if ($action['asButton'] ?? false === true)
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
            @endif
        </dd>
    @endisset
</div>

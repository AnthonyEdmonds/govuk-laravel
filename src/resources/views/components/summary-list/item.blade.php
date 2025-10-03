@props([
    'actions' => [],
    'colour' => null,
    'key',
    'mixedList' => false,
    'status' => null,
    'value',
])

@php
    if (is_array($value) !== true) {
        $value = [$value];
    }

    $rowClasses = 'govuk-summary-list__row';

    $actionsCount = count($actions);
    if ($status !== null) {
        ++$actionsCount;
    }

    if (
        $mixedList === true
        && $actionsCount === 0
    ) {
        $rowClasses .= ' govuk-summary-list__row--no-actions';
    }
@endphp

<div class="{{ $rowClasses }}">
    <dt class="govuk-summary-list__key">{!! $key !!}</dt>

    <dd class="govuk-summary-list__value">
        @foreach($value as $entry)
            <x-govuk::p>{!! $entry !!}</x-govuk::p>
        @endforeach
    </dd>

    @if($actionsCount > 0)
        <dd class="govuk-summary-list__actions">
            <ul class="govuk-summary-list__actions-list">
                @if($status !== null)
                    <li class="govuk-summary-list__actions-list-item">
                        <x-govuk::tag :colour="$colour" :label="$status" />
                    </li>
                @endif

                @foreach($actions as $label => $action)
                    <li class="govuk-summary-list__actions-list-item">
                        @if(is_array($action) === true)
                            <x-govuk::summary-list.action
                                :asButton="$action['asButton'] ?? false"
                                :hidden="$action['hidden'] ?? null"
                                :label="$action['label'] ?? $label"
                                :method="$action['method'] ?? 'post'"
                                :url="$action['url']"
                            />
                        @else
                            <x-govuk::summary-list.action
                                :label="$label"
                                :url="$action"
                            />
                       @endif
                    </li>
                @endforeach
            </ul>
        </dd>
    @endif
</div>

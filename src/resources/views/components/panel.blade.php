@props([
    'title',
    'interruption' => false,
    'confirmLabel' => null,
    'confirmUrl' => null,
    'cancelLabel' => null,
    'cancelUrl' => null,
])

@php
    $classes = 'govuk-panel';

    $classes .= $interruption === true
        ? ' govuk-panel--interruption'
        : ' govuk-panel--confirmation';
@endphp

<div class="{{ $classes }}">
    <h1 class="govuk-panel__title">
        {{ $title }}
    </h1>

    <div class="govuk-panel__body">
        {{ $slot }}
    </div>

    @if($confirmUrl !== null)
        <div class="govuk-panel__actions">
            <x-govuk::button-group>
                <x-govuk::a
                    as-button
                    inverted
                    :href="$confirmUrl"
                >{{ $confirmLabel }}</x-govuk::a>

                @if($cancelUrl !== null)
                    <x-govuk::a
                        :href="$cancelUrl"
                        inverted
                    >{{ $cancelLabel }}</x-govuk::a>
                @endif
            </x-govuk::button-group>
        </div>
    @endif
</div>

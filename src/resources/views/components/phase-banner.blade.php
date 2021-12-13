@props([
    'colour' => 'blue',
    'phase',
])

<div class="govuk-phase-banner">
    <p class="govuk-phase-banner__content">
        <x-govuk::tag :label="$phase" :colour="$colour" :phase="true" />

        <span class="govuk-phase-banner__text">
            {{ $slot }}
        </span>
    </p>
</div>

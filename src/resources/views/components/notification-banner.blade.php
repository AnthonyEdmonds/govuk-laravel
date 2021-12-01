@props([
    'title' => 'Information',
    'colour' => 'dark-blue',
])

<div
    class="govuk-notification-banner app-!-background-govuk-{{ $colour }} app-!-border-govuk-{{ $colour }}"
    role="region"
    aria-labelledby="govuk-notification-banner-title"
    data-module="govuk-notification-banner"
>
    <div class="govuk-notification-banner__header">
        <h2 class="govuk-notification-banner__title" id="govuk-notification-banner-title">
            {{ $title }}
        </h2>
    </div>

    <div class="govuk-notification-banner__content">
        {{ $slot }}
    </div>
</div>

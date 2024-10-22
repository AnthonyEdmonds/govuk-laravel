<x-govuk::header
    logo-alt="{{ config('govuk.header.logo.alt') }}"
    logo-height="{{ config('govuk.header.logo.height') }}"
    logo-image="{{ asset(config('govuk.header.logo.asset')) }}"
    logo-route="{{ config('govuk.header.route') }}"
/>
<x-govuk::service-navigation
    current-section="{{ $currentSection ?? null }}"
    :links="{{ config('govuk.header.links') }}"
    service-name="{{ config('govuk.header.service_name') }}"
/>

// TODO WOrking on 5.6.0
// https://github.com/alphagov/govuk-frontend/releases?page=1
// Update configuration.md
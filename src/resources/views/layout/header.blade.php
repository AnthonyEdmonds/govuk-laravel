<x-govuk::header
    logo-alt="{{ config('govuk.header.logo.alt') }}"
    logo-height="{{ config('govuk.header.logo.height') }}"
    logo-image="{{ asset(config('govuk.header.logo.asset')) }}"
    logo-route="{{ config('govuk.header.route') }}"
/>

<x-govuk::service-navigation
    current-section="{{ $currentSection ?? '' }}"
    :links="config('govuk.header.links')"
    service-name="{{ config('govuk.header.service_name') }}"
    service-route="{{ config('govuk.header.route') }}"
/>

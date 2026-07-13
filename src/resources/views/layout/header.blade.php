@php
$logoPath = config('govuk.header.logo.asset');

if (str_contains($logoPath, '://') === false) {
    $logoPath = str_contains($logoPath, '/') === true
        ? asset($logoPath)
        : route($logoPath);
}
@endphp

<x-govuk::header
    logo-alt="{{ config('govuk.header.logo.alt') }}"
    logo-height="{{ config('govuk.header.logo.height') }}"
    logo-image="{{ $logoPath }}"
    logo-route="{{ config('govuk.header.route') }}"
/>

<x-govuk::service-navigation
    current-section="{{ $currentSection ?? '' }}"
    :links="config('govuk.header.links')"
    service-name="{{ config('govuk.header.service_name') }}"
    service-route="{{ config('govuk.header.route') }}"
/>

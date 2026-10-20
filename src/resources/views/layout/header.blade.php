@use(AnthonyEdmonds\GovukLaravel\Helpers\GovukUrl)

<x-govuk::generic-header
    label="{{ config('govuk.header.label') }}"
    logo-alt="{{ config('govuk.header.logo.alt') }}"
    logo-height="{{ config('govuk.header.logo.height') }}"
    logo-image="{{ GovukUrl::resolvePathFromConfig('govuk.header.logo.asset') }}"
    logo-route="{{ config('govuk.header.route') }}"
/>

<x-govuk::service-navigation
    current-section="{{ $currentSection ?? '' }}"
    :links="config('govuk.header.links')"
    service-name="{{ config('govuk.header.service_name') }}"
    service-route="{{ config('govuk.header.route') }}"
>
    <x-slot name="end">
        @if(config('govuk.languages.route') !== null)
            <x-govuk::languages
                :languages="config('govuk.languages.list')"
                route="{{ config('govuk.languages.route') }}"
            />
        @endempty
    </x-slot>
</x-govuk::service-navigation>

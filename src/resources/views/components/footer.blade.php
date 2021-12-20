@props([
    'licenceLogo' => null,
    'licenceLogoHeight' => null,
    'licenceLogoWidth' => null,
    'metaHeading' => null,
    'metaLinks' => [],
    'navigationLinks' => [],
])

<footer class="govuk-footer" role="contentinfo">
    <div class="govuk-width-container">
        <x-govuk::footer.navigation
            :navigation="$navigationLinks"
        />

        <x-govuk::footer.meta
            :height="$licenceLogoHeight"
            :heading="$metaHeading"
            :links="$metaLinks"
            :logo="$licenceLogo"
            :width="$licenceLogoWidth"
        >
            <x-slot name="information">
                {{ $information }}
            </x-slot>

            <x-slot name="licence">
                {{ $licence }}
            </x-slot>

            <x-slot name="logos">
                {{ $logos }}
            </x-slot>
        </x-govuk::footer.meta>
    </div>
</footer>
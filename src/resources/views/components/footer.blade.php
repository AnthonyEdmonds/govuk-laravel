@props([
    'licenceLogo' => null,
    'licenceLogoHeight' => null,
    'licenceLogoWidth' => null,
    'metaHeading' => null,
    'metaLinks' => [],
    'navigationLinks' => [],
])

<footer class="govuk-footer">
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
            @isset($information)
                <x-slot name="information">
                    {{ $information }}
                </x-slot>
            @endisset

            @isset($licence)
                <x-slot name="licence">
                    {{ $licence }}
                </x-slot>
            @endisset

            @isset($logos)
                <x-slot name="logos">
                    {{ $logos }}
                </x-slot>
            @endisset
        </x-govuk::footer.meta>
    </div>
</footer>
<x-govuk::footer
    licence-logo="{{ asset('images/ogl-logo.svg') }}"
    licence-logo-height="17"
    meta-heading="Support"
    :meta-links="[]"
    :navigation-links="[]"
>
    <x-slot name="information">
        Built by the
        <a
            href="#"
            class="govuk-footer__link"
        >Government Digital Service</a>
    </x-slot>

    <x-slot name="licence">
        All content is available under the
        <a
            class="govuk-footer__link"
            href="https://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/"
            rel="license"
        >Open Government Licence v3.0</a>
        , except where otherwise stated
    </x-slot>

    <x-slot name="logos">
        <a
            class="govuk-footer__link govuk-footer__copyright-logo"
            href="https://www.nationalarchives.gov.uk/information-management/re-using-public-sector-information/uk-government-licensing-framework/crown-copyright/"
        >&copy; Crown copyright</a>
    </x-slot>
</x-govuk::footer>

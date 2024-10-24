@props([
    'logoAlt',
    'logoHeight' => 44,
    'logoImage',
    'logoRoute',
])

<header
    class="govuk-header govuk-header--full-width-border"
    data-module="govuk-header"
>
    <div class="govuk-header__container govuk-width-container">
        <div class="govuk-header__logo">
            <a
                href="{{ route($logoRoute) }}"
                class="govuk-header__link govuk-header__link--homepage"
            >
                <img
                    src="{{ $logoImage }}"
                    alt="{{ $logoAlt }}"
                    class="govuk-!-padding-2"
                    height="{{ $logoHeight }}"
                />
            </a>
        </div>
    </div>
</header>

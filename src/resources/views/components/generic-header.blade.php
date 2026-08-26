@props([
    'label' => '',
    'logoAlt',
    'logoHeight' => 44,
    'logoImage',
    'logoRoute',
])

<div class="govuk-generic-header">
    <div class="govuk-generic-header__container govuk-width-container">
        <div class="govuk-generic-header__logo">
            <a
                href="{{ route($logoRoute) }}"
                class="govuk-generic-header__homepage-link"
            >
                <img
                    src="{{ $logoImage }}"
                    alt="{{ $logoAlt }}"
                    height="{{ $logoHeight }}"
                />
                {{ $label }}
            </a>
        </div>
    </div>
</div>

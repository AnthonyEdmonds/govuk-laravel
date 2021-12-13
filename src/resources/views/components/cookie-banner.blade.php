@props([
    'label' => 'Cookies on ' . env('APP_NAME'),
])

<div
    class="govuk-cookie-banner"
    data-nosnippet
    role="region"
    aria-label="{{ $label }}"
>
    <div class="govuk-cookie-banner__message govuk-width-container">
        <div class="govuk-grid-row">
            <div class="govuk-grid-column-full">
                <h2 class="govuk-cookie-banner__heading govuk-heading-m">
                    {{ $label }}
                </h2>

                <div class="govuk-cookie-banner__content">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <div class="govuk-button-group">
            {{ $buttons }}
        </div>
    </div>
</div>

@props([
    'description' => 'Tell us about your experience using this service.',
    'header' => 'Help us improve this service',
    'link_label' => 'Give us your feedback',
    'route',
])

<div class="govuk-feedback govuk-width-container">
    <div class="govuk-grid-row">
        <div class="govuk-grid-column-two-thirds">
            <h2 class="govuk-feedback__title">{{ $header }}</h2>
            <div class="govuk-feedback__body">
                <x-govuk::p>
                    {{ $description }}
                    <x-govuk::a href="{{ route($route) }}">{{ $link_label }}</x-govuk::a>
                </x-govuk::p>
            </div>
        </div>
    </div>
</div>

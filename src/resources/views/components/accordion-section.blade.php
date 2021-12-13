@aware([
    'id'
])

@props([
    'label',
    'subid' => uniqid(),
    'summary' => null,
])

<div class="govuk-accordion__section ">
    <div class="govuk-accordion__section-header">
        <h2 class="govuk-accordion__section-heading">
            <span
                class="govuk-accordion__section-button"
                id="accordion-{{ $id }}-heading-{{ $subid }}"
            >
                {{ $label }}
            </span>
        </h2>

        @isset($summary)
            <div
                class="govuk-accordion__section-summary govuk-body"
                 id="accordion-{{ $id }}-summary-{{ $subid }}"
            >
                {{ $summary }}
            </div>
        @endisset
    </div>

    <div
        id="accordion-default-content-1"
        class="govuk-accordion__section-content"
        aria-labelledby="accordion-{{ $id }}-heading-{{ $subid }}"
    >
        {{ $slot }}
    </div>
</div>

@props([
    'label'
])

<details class="govuk-details">
    <summary class="govuk-details__summary">
        <span class="govuk-details__summary-text">
            {!! $label !!}
        </span>
    </summary>

    <div class="govuk-details__text">
        {{ $slot }}
    </div>
</details>

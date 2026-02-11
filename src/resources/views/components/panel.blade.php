@props([
    'title'
])

<div class="govuk-panel govuk-panel--confirmation">
    <h1 class="govuk-panel__title">
        {{ $title }}
    </h1>

    <div class="govuk-panel__body">
        {{ $slot }}
    </div>
</div>

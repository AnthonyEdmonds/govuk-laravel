@props([
    'emergency' => true,
    'href',
    'label' => 'Exit this page'
])

<div
    class="govuk-exit-this-page"
    data-module="govuk-exit-this-page"
>
    <a
        href="{{ $href }}"
        role="button"
        draggable="false"
        class="govuk-button govuk-button--warning govuk-exit-this-page__button govuk-js-exit-this-page-button"
        data-module="govuk-button"
        rel="nofollow noreferrer"
    >
        @if($emergency === true)<span class="govuk-visually-hidden">Emergency</span>@endif
        {{ $label }}
    </a>
</div>

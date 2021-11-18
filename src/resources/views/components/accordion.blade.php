@props([
    'id' => uniqid(),
])

<div
    class="govuk-accordion"
    data-module="govuk-accordion"
    id="accordion-{{ $id }}"
>
    {{ $slot }}
</div>

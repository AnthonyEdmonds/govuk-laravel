@props([
    'height' => null,
    'logo' => null,
    'width' => null
])

<img
    aria-hidden="true"
    class="govuk-footer__licence-logo"
    height="{{ $height }}"
    src="{{ $logo }}"
    width="{{ $width }}"
/>

<span class="govuk-footer__licence-description">
    {{ $slot }}
</span>

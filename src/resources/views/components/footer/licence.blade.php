@props([
    'height' => null,
    'logo' => null,
    'width' => null
])

@if($logo !== null)
    <img
        aria-hidden="true"
        class="govuk-footer__licence-logo"
        height="{{ $height }}"
        src="{{ $logo }}"
        width="{{ $width }}"
    />
@endif

<span class="govuk-footer__licence-description">
    {{ $slot }}
</span>

@props([
    'ariaDescribedby' => null,
    'asButton' => false,
    'asStartButton' => false,
    'footer' => false,
    'href',
    'image' => false,
    'inverted' => false,
    'rel' => null,
    'secondary' => false,
    'target' => '_self',
])

@php
    if ($footer === true) {
        $classes = 'govuk-footer__link';
        
    } elseif ($image === true) {
        $classes = 'govuk-link-image';
        
    } elseif ($asButton === true || $asStartButton === true) {
        $classes = 'govuk-button';
        
        if ($asStartButton === true) {
            $classes .= ' govuk-button--start';
        } 
        
        if ($inverted === true) {
            $classes .= ' govuk-button--inverse';
        }

        if ($secondary === true) {
            $classes .= ' govuk-button--secondary';
        }
    } else {
        $classes = 'govuk-link';
        
        if ($inverted === true) {
            $classes .= ' govuk-link--inverse';
        }
    }
@endphp

<a
    @if($ariaDescribedby !== null)
        aria-describedby="{{ $ariaDescribedby }}"
    @endif
    class="{{ $classes }}"
    href="{!! $href !!}"
    @if($rel !== null)
        rel="{{ $rel }}"
    @endif
    target="{{ $target }}"
>{{ $slot }}@if($asStartButton === true)
    <svg
        class="govuk-button__start-icon"
        xmlns="http://www.w3.org/2000/svg"
        width="17.5"
        height="19"
        viewBox="0 0 33 40"
        aria-hidden="true"
        focusable="false"
    >
        <path fill="currentColor" d="M0 0h13l20 20-20 20H0l20-20z" />
    </svg>
@endif</a>

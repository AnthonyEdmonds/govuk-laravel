@props([
    'asButton' => false,
    'asStartButton' => false,
    'footer' => false,
    'href',
    'inverted' => false,
    'target' => '_self',
])

@php
    if ($footer === true) {
        $linkClasses = 'govuk-footer__link';

    } elseif ($asButton === true || $asStartButton === true) {
        $linkClasses = 'govuk-button';
        
        if ($asStartButton === true) {
            $linkClasses .= ' govuk-button--start';
        } 
        
        if ($inverted === true) {
            $linkClasses .= ' govuk-button--inverse';
        }
    } else {
        $linkClasses = 'govuk-link';
        
        if ($inverted === true) {
            $linkClasses .= ' govuk-link--inverse';
        }
    }
@endphp

<a
    class="{{ $linkClasses }}"
    href="{{ $href }}"
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

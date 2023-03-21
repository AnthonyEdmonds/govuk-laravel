@props([
    'asLink' => false,
    'asStartButton' => false,
    'disabled' => false,
    'formAction' => null,
    'formMethod' => null,
    'preventDoubleClick' => false,
    'secondary' => false,
    'type' => null,
    'warning' => false,
])

@php
    $classes = 'govuk-button';

    if ($disabled === true) {
        $classes .= ' govuk-button--disabled';
    }

    if ($secondary === true || $type === 'secondary') {
        $classes .= ' govuk-button--secondary';
    }

    if ($asStartButton === true || $type === 'start') {
        $classes .= ' govuk-button--start';
    }

    if ($warning === true || $type === 'warning') {
        $classes .= ' govuk-button--warning';
    }

    if ($asLink === true) {
        $classes .= ' app-button--as-link';
    }
@endphp

<button
    class="{{ $classes }}"
    data-module="govuk-button"
    
    @if($formAction !== null)
        formaction="{{$formAction}}"
    @endif
            
    @if($formMethod !== null)
        formmethod="{{$formMethod}}"
    @endif

    @if($disabled === true)
        aria-disabled="true"
        disabled
    @endif

    @if($preventDoubleClick === true)
        data-prevent-double-click="true"
    @endif
>
    {{ $slot }}
    @if($asStartButton === true || $type === 'start')
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
    @endif
</button>

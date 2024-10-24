@props([
    'asLink' => false,
    'asStartButton' => false,
    'controls' => null,
    'disabled' => false,
    'formAction' => null,
    'formMethod' => null,
    'hidden' => false,
    'id' => null,
    'inverted' => false,
    'label' => null,
    'mode' => null,
    'password' => false,
    'preventDoubleClick' => false,
    'secondary' => false,
    'type' => null,
    'warning' => false,
])

@php
    $classes = 'govuk-button';
    
    if ($secondary === true || $mode === 'secondary') {
        $classes .= ' govuk-button--secondary';
    }

    if ($asStartButton === true || $mode === 'start') {
        $classes .= ' govuk-button--start';
    }

    if ($warning === true || $mode === 'warning') {
        $classes .= ' govuk-button--warning';
    }
    
    if ($inverted === true) {
        $classes .= ' govuk-button--inverse';
    }

    if ($asLink === true) {
        $classes .= ' app-button--as-link';
    }

    if ($password === true) {
        $classes .= ' govuk-password-input__toggle govuk-js-password-input-toggle';
    }
@endphp

<button
    class="{{ $classes }}"
    data-module="govuk-button"

    @if(empty($type) === false)
        type="{{ $type }}"
    @endif

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
        
    @if($id !== null)
        id="{{$id}}"
    @endif

    @if($hidden === true)
        hidden
    @endif

    @if($label !== null)
        aria-label="{{ $label }}"
    @endif

    @if($controls !== null)
        aria-controls="{{ $controls }}"
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

@props([
    'hint' => null,
    'id' => $name,
    'label',
    'labelSize' => 's',
    'name',
    'title' => false,

    'count' => null,
    'threshold' => null,
    'words' => null,
])

@php
    $groupClasses = 'govuk-form-group';
    $hasCount = $count !== null || $words !== null;

    if ($errors->has($name) === true) {
        $groupClasses .= ' govuk-form-group--error';
    }
@endphp

@if($hasCount === true)
    <div
        class="govuk-character-count"
        data-module="govuk-character-count"

        @if($threshold !== null)
            data-threshold="{{ $threshold }}"
        @endif

        @if($words !== null)
            data-maxwords="{{ $words }}"
        @else
            data-maxlength="{{ $count }}"
        @endif
    >
@endif

<div class="{{ $groupClasses }}">
    @if($title === true)
        <h1 class="govuk-label-wrapper">
    @endif

        <label class="govuk-label govuk-label--{{ $labelSize }}" for="{{ $id }}">
            {{ $label }}
        </label>

    @if($title === true)
        </h1>
    @endif

    @isset($hint)
        <div class="govuk-hint" id="{{ $id }}-hint" >
            {{ $hint }}
        </div>
    @endisset

    @error($name)
        <span class="govuk-error-message" id="{{ $id }}-error" >
            <span class="govuk-visually-hidden">Error: </span>{{ $message }}
        </span>
    @enderror

    {!! $slot !!}

    @if($hasCount === true)
        <div id="{{ $id }}-info" class="govuk-hint govuk-character-count__message" aria-live="polite">
            You can enter up to {{ $count }} characters
        </div>
    @endif
</div>

@if($hasCount === true)
    </div>
@endif

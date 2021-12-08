@props([
    'id' => $name,
    'name',
    'option',
    'selected' => null,
    'value'
])

@php
    // TODO Conditional inputs
    
    $divider = $option['divider'] ?? false === true;
    $hint = $option['hint'] ?? null;
    $label = is_array($option) === true ? $option['label'] : $option;
    $isChecked = $value == $selected;
@endphp

@if($divider === true)
    <div class="govuk-radios__divider">{{ $label }}</div>
@else
    <div class="govuk-radios__item">
        <input
            class="govuk-radios__input"
            id="{{ $id }}"
            name="{{ $name }}"
            type="radio"
            value="{{ $value }}"
            @if($isChecked === true)
                checked
            @endif
        />
    
        <label
            class="govuk-label govuk-radios__label"
            for="{{ $id }}"
        >
            {{ $label }}
        </label>
    
        @if($hint !== null)
            <div id="{{ $id }}-hint" class="govuk-hint govuk-radios__hint">
                {{ $hint }}
            </div>
        @endif
    </div>
@endif
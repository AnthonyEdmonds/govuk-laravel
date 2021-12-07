@props([
    'id' => $name,
    'label',
    'name',
    'option',
    'selected' => null,
])

@php
    // TODO Conditional inputs
    
    $divider = true === $option['divider'] ?? false;
    $hint = $option['hint'] ?? null;
    $value = is_array($option) === true ? $option['value'] : $option;
    
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
            value="england"
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

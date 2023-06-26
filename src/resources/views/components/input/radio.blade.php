@props([
    'id' => $name,
    'name',
    'option',
    'selected' => null,
    'value'
])

@php
    $divider = $option['divider'] ?? false === true;
    $hint = $option['hint'] ?? null;
    $label = is_array($option) === true ? $option['label'] : $option;
    $isChecked = $value == $selected;

    $inputs = $option['inputs'] ?? null;
    $hasInputs = $inputs !== null;
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

            @if($hasInputs === true)
            data-aria-controls="conditional-{{ $id }}"
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

    @if($hasInputs === true)
        <div
            class="govuk-radios__conditional govuk-radios__conditional--hidden"
            id="conditional-{{ $id }}"
        >
            @foreach($inputs as $type => $settings)
                {!!
                    \AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion::new(
                        is_string($type) === true ? $type : \AnthonyEdmonds\GovukLaravel\Questions\Question::TEXT_INPUT,
                        $settings,
                    )->toBlade()
                !!}
            @endforeach
        </div>
    @endif
@endif

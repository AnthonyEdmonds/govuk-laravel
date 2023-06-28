@props([
    'id' => $name,
    'name',
    'option',
    'selections' => [],
    'value'
])

@php
    $divider = $option['divider'] ?? false === true;
    $hint = $option['hint'] ?? null;
    $label = is_array($option) === true ? $option['label'] : $option;
    $isChecked = in_array($value, $selections) === true;
    $isExclusive = $option['exclusive'] ?? false === true;
    $inputs = $option['inputs'] ?? null;
    $hasInputs = $inputs !== null;
@endphp

@if($divider === true)
    <div class="govuk-checkboxes__divider">{{ $label }}</div>
@else
    <div class="govuk-checkboxes__item">
        <input
            class="govuk-checkboxes__input"
            id="{{ $id }}"
            name="{{ $name }}"
            type="checkbox"
            value="{{ $value }}"

            @if($isChecked === true)
            checked
            @endif

            @if($hasInputs === true)
            data-aria-controls="conditional-{{ $id }}"
            @endif

            @if($isExclusive === true)
            data-behaviour="exclusive"
            @endif
        />

        <label
            class="govuk-label govuk-checkboxes__label"
            for="{{ $id }}"
        >
            {{ $label }}
        </label>

        @if($hint !== null)
            <div id="{{ $id }}-hint" class="govuk-hint govuk-checkboxes__hint">
                {{ $hint }}
            </div>
        @endif
    </div>

    @if($hasInputs === true)
        <div
            class="govuk-checkboxes__conditional govuk-checkboxes__conditional--hidden"
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

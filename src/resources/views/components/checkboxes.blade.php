@props([
    'hint' => null,
    'id' => $name,
    'isSmall' => false,
    'isTitle' => false,
    'label',
    'labelSize' => 'l',
    'name',
    'options' => [],
    'value' => null,
])

@php
    $hasConditionalInputs = false;
    foreach ($options as $option) {
        if (isset($option['inputs']) === true) {
            $hasConditionalInputs = true;
            break;
        }
    }

    $ariaDescription = '';
    $inputClasses = 'govuk-checkboxes';
    $oldName = \AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion::bracketsToDots($name);

    if ($isSmall === true) {
        $inputClasses .= ' govuk-checkboxes--small';
    }

    if ($hasConditionalInputs === true) {
        $inputClasses .= ' govuk-checkboxes--conditional';
    }

    $value = old($oldName, $value);
    if (is_array($value) === false) {
        $value = $value !== null
            ? [$value]
            : [];
    }
@endphp

<x-govuk::form-group :name="$name">
    <x-govuk::fieldset
        :id="$id"
        :isTitle="$isTitle"
        :label="$label"
        :labelSize="$labelSize"
    >
        <x-govuk::form-group.hint :id="$id" :hint="$hint" />
        <x-govuk::form-group.error :id="$id" :name="$name" />

        <div class="{{ $inputClasses }}" data-module="govuk-checkboxes">
            @foreach($options as $optionValue => $option)
                <x-govuk::input.checkbox
                    id="{{ $id }}_{{ $loop->iteration }}"
                    name="{{$name}}[]"
                    :option="$option"
                    :selections="$value"
                    :value="$optionValue"
                />
            @endforeach
        </div>
    </x-govuk::fieldset>
</x-govuk::form-group>

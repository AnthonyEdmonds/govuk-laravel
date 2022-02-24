@props([
    'hint' => null,
    'id' => $name,
    'isInline' => false,
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
    $inputClasses = 'govuk-radios';
    $oldName = \AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion::bracketsToDots($name);

    if ($isSmall === true) {
        $inputClasses .= ' govuk-radios--small';
    }

    if ($hasConditionalInputs === true) {
        $inputClasses .= ' govuk-radios--conditional';
    } elseif ($isInline === true) {
        $inputClasses .= ' govuk-radios--inline';
    }

    $value = old($oldName, $value);
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

        <div class="{{ $inputClasses }}" data-module="govuk-radios">
            <x-govuk::hidden-input
                id="{{ $id }}_0"
                :name="$name"
                value=""
            />

            @foreach($options as $optionValue => $option)
                <x-govuk::input.radio
                    id="{{ $id }}_{{ $loop->iteration }}"
                    :name="$name"
                    :option="$option"
                    :selected="$value"
                    :value="$optionValue"
                />
            @endforeach
        </div>
    </x-govuk::fieldset>
</x-govuk::form-group>

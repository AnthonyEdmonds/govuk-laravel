@props([
    'hint' => null,
    'id' => $name,
    'isSmall' => false,
    'isTitle' => false,
    'label',
    'labelSize' => null,
    'name',
    'options' => [],
    'value' => null,
])

@use(AnthonyEdmonds\GovukLaravel\Helpers\GovukPage)
@use(Illuminate\Contracts\Support\Arrayable)

@php
    $hasConditionalInputs = false;
    $isEnum = false;

    foreach ($options as $option) {
        if ($option instanceof BackedEnum) {
            $isEnum = true;
            break;

        } elseif (isset($option['inputs']) === true) {
            $hasConditionalInputs = true;
            break;
        }
    }

    if ($isEnum === true) {
        $list = [];

        foreach ($options as $option) {
            $list[$option->name] = $option->value;
        }

        $options = $list;
    }

    $ariaDescription = '';
    $inputClasses = 'govuk-checkboxes';
    $oldName = GovukPage::bracketsToDots($name);

    if ($isSmall === true) {
        $inputClasses .= ' govuk-checkboxes--small';
    }

    if ($hasConditionalInputs === true) {
        $inputClasses .= ' govuk-checkboxes--conditional';
    }

    if ($value instanceof Arrayable === true) {
        $value = $value->toArray();
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
        :is-title="$isTitle"
        :label="$label"
        :label-size="$labelSize"
    >
        <x-govuk::form-group.hint :id="$id" :hint="$hint"/>
        <x-govuk::form-group.error :id="$id" :name="$name"/>

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

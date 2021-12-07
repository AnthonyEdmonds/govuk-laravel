@props([
    'autocomplete' => 'on',
    'hint' => null,
    'id' => $name,
    'label',
    'labelSize' => 's',
    'name',
    'options' => [],
    'isTitle' => false,
    'value' => null,
])

@php
    $ariaDescription = '';
    $inputClasses = 'govuk-select';

    if ($hint !== null) {
        $ariaDescription .= "{$id}-hint";
    }

    if ($errors->has($name) === true) {
        $ariaDescription .= " {$id}-error";
        $inputClasses .= ' govuk-select--error';
    }

    $value = old($name, $value);
@endphp

<x-govuk::form-group :name="$name">
    <x-govuk::form-group.label
        :id="$id"
        :label="$label"
        :label-size="$labelSize"
        :isTitle="$isTitle"
    />
    <x-govuk::form-group.hint :id="$id" :hint="$hint" />
    <x-govuk::form-group.error :id="$id" :name="$name" />
    
    <select
        aria-describedby="{{ $ariaDescription }}"
        autocomplete="{{ $autocomplete }}"
        class="{{ $inputClasses }}"
        id="{{ $id }}"
        name="{{ $name }}"
    >
        <option value="">Select an option...</option>

        @foreach($options as $key => $label)
            <option
                {{ $key == $value ? 'selected' : '' }}
                value="{{ $key }}"
            >
                {{ $label }}
            </option>
        @endforeach
    </select>
</x-govuk::form-group>

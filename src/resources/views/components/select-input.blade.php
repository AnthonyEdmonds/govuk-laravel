@props([
    'autocomplete' => 'on',
    'hint' => null,
    'id' => $name,
    'label',
    'labelSize' => 's',
    'name',
    'options' => [],
    'title' => false,
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

<x-form-group
    :hint="$hint"
    :id="$id"
    :label="$label"
    :label-size="$labelSize"
    :name="$name"
    :title="$title"
>
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
</x-form-group>

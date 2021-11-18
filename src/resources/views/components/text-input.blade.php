@props([
    'autocomplete' => 'on',
    'count' => false,
    'hint' => null,
    'id' => $name,
    'inputmode' => 'text',
    'label',
    'labelSize' => 's',
    'name',
    'placeholder' => null,
    'spellcheck' => 'false',
    'threshold' => false,
    'title' => false,
    'type' => 'text',
    'value' => null,
    'width' => null,
    'words' => false,
])

@php
    $ariaDescription = '';
    $inputClasses = 'govuk-input';

    if ($hint !== null) {
        $ariaDescription .= "{$id}-hint";
    }

    if ($width !== null) {
        $inputClasses .= " govuk-input--width-$width";
    }

    if ($count !== false || $words !== false) {
        $inputClasses .= ' govuk-js-character-count';
    }

    if ($errors->has($name) === true) {
        $ariaDescription .= " {$id}-error";
        $inputClasses .= ' govuk-input--error';
    }
@endphp

<x-form-group
    :count="$count"
    :hint="$hint"
    :id="$id"
    :label="$label"
    :label-size="$labelSize"
    :name="$name"
    :threshold="$threshold"
    :title="$title"
    :words="$words"
>
    <input
        aria-describedby="{{ $ariaDescription }}"
        autocomplete="{{ $autocomplete }}"
        class="{{ $inputClasses }}"
        id="{{ $id }}"
        inputmode="{{ $inputmode }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        spellcheck="{{ $spellcheck == true ? 'true' : 'false' }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
    />
</x-form-group>

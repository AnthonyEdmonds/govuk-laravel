@props([
    'autocomplete' => 'on',
    'count' => null,
    'hint' => null,
    'id' => $name,
    'label',
    'labelSize' => 's',
    'name',
    'placeholder' => null,
    'rows' => 5,
    'spellcheck' => 'false',
    'threshold' => null,
    'isTitle' => false,
    'value' => null,
    'words' => null,
])

@php
    $ariaDescription = '';
    $inputClasses = 'govuk-textarea';

    if ($hint !== null) {
        $ariaDescription .= "{$id}-hint";
    }

    if ($count !== null || $words !== null) {
        $inputClasses .= ' govuk-js-character-count';
    }

    if ($errors->has($name) === true) {
        $ariaDescription .= " {$id}-error";
        $inputClasses .= ' govuk-textarea--error';
    }
@endphp

<x-govuk::form-group.count
    :count="$count"
    :threshold="$threshold"
    :words="$words"
>
    <x-govuk::form-group :name="$name">
        <x-govuk::form-group.label
            :id="$id"
            :label="$label"
            :label-size="$labelSize"
            :isTitle="$isTitle"
        />
        <x-govuk::form-group.hint :id="$id" :hint="$hint" />
        <x-govuk::form-group.error :id="$id" :name="$name" />
        
        <textarea
            aria-describedby="{{ $ariaDescription }}"
            autocomplete="{{ $autocomplete }}"
            class="{{ $inputClasses }}"
            id="{{ $id }}"
            inputmode="{{ $inputmode }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            rows="{{ $rows }}"
            spellcheck="{{ $spellcheck == true ? 'true' : 'false' }}"
        >{{ old($name, $value) }}</textarea>

        <x-govuk::form-group.counter :id="$id" />
    </x-govuk::form-group>
</x-govuk::form-group.count>

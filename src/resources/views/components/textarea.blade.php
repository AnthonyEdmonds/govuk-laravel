@props([
    'autocomplete' => 'on',
    'count' => null,
    'hint' => null,
    'id' => $name,
    'inputmode' => 'text',
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
    $oldName = \AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion::bracketsToDots($name);

    if ($hint !== null) {
        $ariaDescription .= "{$id}-hint";
    }

    if ($count !== null || $words !== null) {
        $inputClasses .= ' govuk-js-character-count';
    }

    if ($errors->has($oldName) === true) {
        $ariaDescription .= " {$id}-error";
        $inputClasses .= ' govuk-textarea--error';
    }
@endphp

<x-govuk::form-group
    :count="$count"
    :id="$id"
    :name="$name"
    :threshold="$threshold"
    :words="$words"
>
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
    >{{ old($oldName, $value) }}</textarea>
</x-govuk::form-group>

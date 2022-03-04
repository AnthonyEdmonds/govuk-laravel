@props([
    'accept' => '*',
    'hint' => null,
    'id' => $name,
    'label',
    'labelSize' => 's',
    'name',
    'isTitle' => false,
])

@php
    $ariaDescription = '';
    $inputClasses = 'govuk-file-upload';
    $oldName = \AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion::bracketsToDots($name);

    if ($hint !== null) {
        $ariaDescription .= "{$id}-hint";
    }

    if ($errors->has($oldName) === true) {
        $ariaDescription .= " {$id}-error";
        $inputClasses .= ' govuk-file-upload--error';
    }
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

    <input
        accept="{{ $accept }}"
        class="{{ $inputClasses }}"
        id="{{ $id }}"
        name="{{ $name }}"
        type="file"
        aria-describedby="{{ $ariaDescription }}"
    />
</x-govuk::form-group>

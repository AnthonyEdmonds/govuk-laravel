@props([
    'hint' => null,
    'id' => $name,
    'inputmode' => 'text',
    'label',
    'labelSize' => null,
    'name',
    'new' => false,
    'isTitle' => false,
    'value' => null,
    'width' => null,
])

@use(AnthonyEdmonds\GovukLaravel\Helpers\GovukPage)

@php
    $ariaDescription = '';
    $inputClasses = 'govuk-input govuk-password-input__input govuk-js-password-input-input';
    $oldName = GovukPage::bracketsToDots($name);

    if ($hint !== null) {
        $ariaDescription .= "{$id}-hint";
    }

    if ($width !== null) {
        $inputClasses .= " govuk-input--width-$width";
    }

    if ($errors->has($oldName) === true) {
        $ariaDescription .= " {$id}-error";
        $inputClasses .= ' govuk-input--error';
    }

    $autocomplete = $new === true
        ? 'new-password'
        : 'current-password';
@endphp

<x-govuk::form-group
    data-module="govuk-password-input"
    :name="$name"
    password
>
    <x-govuk::form-group.label
        :id="$id"
        :label="$label"
        :label-size="$labelSize"
        :is-title="$isTitle"
    />
    <x-govuk::form-group.hint :id="$id" :hint="$hint" />
    <x-govuk::form-group.error :id="$id" :name="$name" />

    <div class="govuk-input__wrapper govuk-password-input__wrapper">
        <input
            aria-describedby="{{ $ariaDescription }}"
            autocapitalize="none"
            autocomplete="{{ $autocomplete }}"
            class="{{ $inputClasses }}"
            id="{{ $id }}"
            inputmode="{{ $inputmode }}"
            name="{{ $name }}"
            spellcheck="false"
            type="password"
            value="{{ old($oldName, $value) }}"
        />

        <x-govuk::button
            controls="{{ $id }}"
            hidden
            label="Show password"
            password
            secondary
            type="button"
        >Show</x-govuk::button>
    </div>
</x-govuk::form-group>

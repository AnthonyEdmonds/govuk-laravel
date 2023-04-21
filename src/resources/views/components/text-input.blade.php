@props([
    'autocomplete' => 'on',
    'extraSpacing' => false,
    'hint' => null,
    'id' => $name,
    'inputmode' => 'text',
    'label',
    'labelSize' => 's',
    'name',
    'placeholder' => null,
    'prefix' => null,
    'spellcheck' => 'false',
    'suffix' => null,
    'isTitle' => false,
    'type' => 'text',
    'value' => null,
    'width' => null,
])

@php
    $ariaDescription = '';
    $inputClasses = 'govuk-input';
    $oldName = \AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion::bracketsToDots($name);
    
    if ($hint !== null) {
        $ariaDescription .= "{$id}-hint";
    }
    
    if ($extraSpacing === true) {
        $inputClasses .= ' govuk-input--extra-letter-spacing';
    }

    if ($width !== null) {
        $inputClasses .= " govuk-input--width-$width";
    }

    if ($errors->has($oldName) === true) {
        $ariaDescription .= " {$id}-error";
        $inputClasses .= ' govuk-input--error';
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

    <div class="govuk-input__wrapper">
        @if($prefix !== null)
            <div class="govuk-input__prefix" aria-hidden="true">{{ $prefix }}</div>
        @endif

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
            value="{{ old($oldName, $value) }}"
        />

        @if($suffix !== null)
            <div class="govuk-input__suffix" aria-hidden="true">{{ $suffix }}</div>
        @endif
    </div>
</x-govuk::form-group>

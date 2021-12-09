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
    'prefix' => null,
    'spellcheck' => 'false',
    'suffix' => null,
    'threshold' => null,
    'isTitle' => false,
    'type' => 'text',
    'value' => null,
    'width' => null,
    'words' => null,
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

    if ($count !== null || $words !== null) {
        $inputClasses .= ' govuk-js-character-count';
    }

    if ($errors->has($name) === true) {
        $ariaDescription .= " {$id}-error";
        $inputClasses .= ' govuk-input--error';
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
        
        <div class="govuk-input__wrapper">
            @if($prefix !== null)
                <div class="govuk-input__suffix" aria-hidden="true">{{ $prefix }}</div>
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
                value="{{ old($name, $value) }}"
            />
            
            @if($suffix !== null)
                <div class="govuk-input__suffix" aria-hidden="true">{{ $suffix }}</div>
            @endif
        </div>
        
        <x-govuk::form-group.counter :id="$id" />
    </x-govuk::form-group>
</x-govuk::form-group.count>

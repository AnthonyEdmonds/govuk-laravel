@props([
    'hint' => null,
    'id' => $name,
    'isInline' => false,
    'label',
    'labelSize' => 'l',
    'name',
    'options' => [],
    'isTitle' => false,
    'value' => null,
])

@php
    $ariaDescription = '';
    $inputClasses = 'govuk-radios';
    
    if ($isInline === true) {
        $inputClasses .= ' govuk-radios--inline';
    }
    
    $value = old($name, $value);
@endphp

<x-govuk::form-group :name="$name">
    <x-govuk::fieldset
        :isTitle="$isTitle"
        :label="$label"
        :labelSize="$labelSize"
    >
        <x-govuk::form-group.hint :id="$id" :hint="$hint" />
        <x-govuk::form-group.error :id="$id" :name="$name" />
        
        <div class="{{ $inputClasses }}">
            @foreach($options as $label => $option)
                <x-govuk::input.radio
                    id="{{ $id }}_{{ $loop->iteration }}"
                    :label="$label"
                    :name="$name"
                    :option="$option"
                    :selected="$value"
                />
            @endforeach
        </div>
    </x-govuk::fieldset>
</x-govuk::form-group>

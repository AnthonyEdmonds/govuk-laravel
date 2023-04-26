@props([
    'hint' => null,
    'id' => $name,
    'isTitle' => false,
    'label',
    'labelSize' => 'l',
    'name',
    'value' => '',
])

@php
    if (is_a($value, Carbon\Carbon::class) === true) {
        $value = $value->format('H:i');
    }
@endphp

<x-govuk::text-input
    :hint="$hint"
    :id="$id"
    :isTitle="$isTitle"
    :label="$label"
    :labelSize="$labelSize"
    :name="$name"
    :value="$value"
    width="5"
/>

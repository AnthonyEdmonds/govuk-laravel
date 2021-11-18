@props([
    'id' => $name,
    'name',
    'value' => null,
])

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="hidden"
    value="{{ $value }}"
/>

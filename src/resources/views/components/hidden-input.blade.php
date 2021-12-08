@props([
    'id' => $name,
    'name',
    'value',
])

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="hidden"
    value="{{ $value }}"
/>

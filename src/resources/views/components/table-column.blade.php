@props([
    'heading' => false,
    'hide' => false,
    'label' => '',
    'numeric' => false,
])

@php
    $content = [
        'heading' => $heading === true,
        'hide' => $hide === true,
        'html' => $slot->toHtml(),
        'label' => $label,
        'numeric' => $numeric === true,
    ];
@endphp

~~{!! json_encode($content) !!}~~

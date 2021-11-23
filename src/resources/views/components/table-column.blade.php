@props([
    'heading' => false,
    'hide' => null,
    'label' => '',
    'numeric' => false,
])

@php
    $content = [
        'heading' => $heading === true,
        'hide' => strlen($hide) > 1 ? $hide : null,
        'html' => $slot->toHtml(),
        'label' => $label,
        'numeric' => $numeric === true,
    ];
@endphp

~~{!! json_encode($content) !!}~~

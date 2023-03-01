@props([
    'heading' => false,
    'hide' => null,
    'label' => '',
    'numeric' => false,
])

@php
    use AnthonyEdmonds\GovukLaravel\Helpers\GovukComponent;
    
    $content = GovukComponent::makeTableColumnJson(
        $heading,
        $hide,
        $label,
        $numeric,
        $slot->toHtml(),
    );
@endphp

~~{!! $content !!}~~

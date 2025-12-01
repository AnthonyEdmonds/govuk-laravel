@props([
    'heading' => false,
    'hide' => null,
    'label' => '',
    'numeric' => false,
    'show' => null,
])

@php
    use AnthonyEdmonds\GovukLaravel\Helpers\GovukComponent;
    
    $content = GovukComponent::makeTableColumnJson(
        $heading,
        $hide,
        $label,
        $numeric,
        $show,
        $slot->toHtml(),
    );
@endphp

~~{!! $content !!}~~

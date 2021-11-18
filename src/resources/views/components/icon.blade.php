@props([
    'icon',
    'label',
    'pack' => 'fas',
])

<span class="fas fa-{{ $icon }}" aria-label="{{ $label }}"></span>

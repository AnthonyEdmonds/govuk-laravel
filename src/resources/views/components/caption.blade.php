@props([
    'size' => 'l',
])

<span class="govuk-caption-{{ $size }}">{{ $slot }}</span>

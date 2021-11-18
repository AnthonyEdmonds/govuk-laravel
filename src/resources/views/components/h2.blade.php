@props([
    'size' => 'm'
])

<h2 class="govuk-heading-{{ $size }}">{{ $slot }}</h2>

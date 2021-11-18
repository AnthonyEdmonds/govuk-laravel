@props([
    'size' => 's'
])

<h3 class="govuk-heading-{{ $size }}">{{ $slot }}</h3>

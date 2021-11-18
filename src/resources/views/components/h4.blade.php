@props([
    'size' => 's'
])

<h4 class="govuk-heading-{{ $size }}">{{ $slot }}</h4>

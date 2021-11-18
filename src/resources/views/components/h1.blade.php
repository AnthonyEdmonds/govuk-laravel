@props([
    'size' => 'l'
])

<h1 class="govuk-heading-{{ $size }}">{{ $slot }}</h1>

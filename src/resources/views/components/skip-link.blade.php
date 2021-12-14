@props([
    'anchor' => 'content',
    'label' => 'Skip to main content',
])

<a href="#{{ $anchor }}" class="govuk-skip-link">{{ $label }}</a>

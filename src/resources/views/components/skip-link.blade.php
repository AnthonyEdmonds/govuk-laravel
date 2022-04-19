@props([
    'anchor' => 'content',
    'label' => 'Skip to main content',
])

<a href="#{{ $anchor }}" class="govuk-skip-link" data-module="govuk-skip-link">{{ $label }}</a>

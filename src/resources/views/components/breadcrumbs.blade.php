@props([
    'breadcrumbs',
    'inverted' => false,
])

@php
    $classes = 'govuk-breadcrumbs';
    
    if ($inverted === true) {
        $classes .= ' govuk-breadcrumbs--inverse';
    }
@endphp

<nav class="{{ $classes }}" aria-label="Breadcrumb">
    <ol class="govuk-breadcrumbs__list">
        @foreach($breadcrumbs as $label => $url)
            <li class="govuk-breadcrumbs__list-item">
                <a class="govuk-breadcrumbs__link" href="{{ $url }}">{{ $label }}</a>
            </li>
        @endforeach
    </ol>
</nav>

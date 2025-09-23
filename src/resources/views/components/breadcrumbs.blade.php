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
                @if(is_integer($label) === true)
                    {{ $url }}
                @else
                    <a class="govuk-breadcrumbs__link" href="{{ $url }}">{{ $label }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>

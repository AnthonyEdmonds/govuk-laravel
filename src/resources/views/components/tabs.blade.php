@props([
    'title',
])

@php
    $tabs = [];
    $html = $slot->toHtml();

    while (($start = strpos($html, '~~')) !== false) {
        $end = strpos($html, '~~', $start + 2);
        $length = $end - $start;

        $tab = explode(
            '|',
            substr($html, $start + 2, $length - 2),
        );

        $tabs[$tab[0]] = $tab[1];
        $html = substr_replace($html, '', $start, $length + 2);
    }
@endphp

<div class="govuk-tabs" data-module="govuk-tabs">
    <h2 class="govuk-tabs__title">
        {{ $title }}
    </h2>

    <ul class="govuk-tabs__list">
        @foreach ($tabs as $id => $label)
            <li class="govuk-tabs__list-item govuk-tabs__list-item--selected">
                <a class="govuk-tabs__tab" href="#{{ $id }}">
                    {{ $label }}
                </a>
            </li>
        @endforeach
    </ul>

    {!! $html !!}
</div>

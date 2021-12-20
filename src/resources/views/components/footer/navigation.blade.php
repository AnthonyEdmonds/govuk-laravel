@props([
    'navigation' => [],
])

@php
    $divisor = match(count($navigation)) {
        6 => 'sixth',
        5 => 'fifth',
        4 => 'quarter',
        3 => 'third',
        2 => 'half',
        default => 'full',
    };
@endphp

@empty($navigation)
@else
    <div class="govuk-footer__navigation">
        @foreach($navigation as $title => $links)
            @php
                $columns = $links['columns'] ?? 0;

                $width = match($columns) {
                    5 => "five-{$divisor}s",
                    4 => "four-{$divisor}s",
                    3 => "three-{$divisor}s",
                    2 => "two-{$divisor}s",
                    1 => "one-{$divisor}",
                    default => $divisor
                };
            @endphp

            <div class="govuk-footer__section govuk-grid-column-{{ $width }}">
                <h2 class="govuk-footer__heading govuk-heading-m">
                    {{ $title }}
                </h2>

                <ul class="govuk-footer__list govuk-footer__list--columns-{{ $columns }}">
                    @foreach($links['links'] ?? $links as $label => $link)
                        @can($link['can'] ?? null)
                            <li class="govuk-footer__list-item">
                                <a
                                    class="govuk-footer__link"
                                    href="{{ route($link['route'] ?? $link) }}"
                                    target="{{ $link['blank'] ?? false === true ? '_blank' : '_self' }}"
                                >
                                    {{ $label }}
                                </a>
                            </li>
                        @endcan
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <hr class="govuk-footer__section-break">
@endempty
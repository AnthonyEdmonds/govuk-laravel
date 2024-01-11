@props([
    'navigation' => [],
])

@php
    $totalColumns = count($navigation);

    foreach ($navigation as $links) {
        if (isset($links['columns']) === true) {
            $totalColumns += $links['columns'] - 1;
        }
    }

    $divisor = match($totalColumns) {
        4 => 'quarter',
        3 => 'third',
        2 => 'half',
        default => 'full',
    };
@endphp

@if(empty($navigation) === false)
    <div class="govuk-footer__navigation">
        @foreach($navigation as $title => $links)
            @php
                $columns = $links['columns'] ?? 0;

                $width = match($columns) {
                    3 => "three-{$divisor}s",
                    2 => "two-{$divisor}s",
                    1 => "one-{$divisor}",
                    default => $totalColumns > 1
                        ? "one-{$divisor}"
                        : $divisor
                };
            @endphp

            <div class="govuk-footer__section govuk-grid-column-{{ $width }}">
                <h2 class="govuk-footer__heading govuk-heading-m">
                    {{ $title }}
                </h2>

                <ul class="govuk-footer__list govuk-footer__list--columns-{{ $columns }}">
                    @foreach($links['links'] ?? $links as $label => $link)
                        @isset($link['auth'])
                            @if($link['auth'] === true)
                                @if(\Illuminate\Support\Facades\Auth::check() === false)
                                    @continue
                                @endif
                            @else
                                @if(\Illuminate\Support\Facades\Auth::check() === true)
                                    @continue
                                @endif
                            @endif
                        @endisset
                    
                        @can($link['can'] ?? null)
                            <li class="govuk-footer__list-item">
                                <a
                                    class="govuk-footer__link"
                                    href="{{ $link['link'] ?? $link }}"
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

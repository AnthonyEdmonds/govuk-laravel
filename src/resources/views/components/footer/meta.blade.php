@props([
    'height' => null,
    'heading' => null,
    'links' => [],
    'logo' => null,
    'width' => null,
])

<div class="govuk-footer__meta">
    <div class="govuk-footer__meta-item govuk-footer__meta-item--grow">
        @if($heading !== null)
            <h2 class="govuk-visually-hidden">{{ $heading }}</h2>
        @endif

        @if(empty($links) === false)
            <ul class="govuk-footer__inline-list">
                @foreach($links as $label => $link)
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
                        <li class="govuk-footer__inline-list-item">
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
        @endif

        @isset($information)
            <div class="govuk-footer__meta-custom">
                {{ $information }}
            </div>
        @endisset

        @isset($licence)
            <x-govuk::footer.licence
                :height="$height"
                :logo="$logo"
                :width="$width"
            >
                {{ $licence }}
            </x-govuk::footer.licence>
        @endisset
    </div>

    @isset($logos)
        <div class="govuk-footer__meta-item">
            {{ $logos }}
        </div>
    @endisset
</div>

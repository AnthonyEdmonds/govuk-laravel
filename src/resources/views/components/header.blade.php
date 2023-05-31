@props([
    'links' => [],
    'logoAlt' => $serviceName,
    'logoLink' => config('govuk.home.link'),
    'logoImage',
    'logoHeight' => 44,
    'serviceName' => null,
])

<header
    class="govuk-header"
    role="banner"
    data-module="govuk-header"
>
    <div class="govuk-header__container govuk-width-container">
        <div class="govuk-header__logo">
            <a
                href="{{ $logoLink }}"
                class="govuk-header__link govuk-header__link--homepage"
            >
                <span class="govuk-header__logotype">
                    <img
                        src="{{ $logoImage }}"
                        alt="{{ $logoAlt }}"
                        class="govuk-!-padding-2"
                        height="{{ $logoHeight }}"
                    />
                </span>
            </a>
        </div>

        <div class="govuk-header__content">
            @isset($serviceName)
                <a
                    href="{{ $logoLink }}"
                    class="govuk-header__link govuk-header__service-name"
                >
                    {{ $serviceName }}
                </a>
            @endisset

            <nav
                class="govuk-header__navigation"
                aria-label="Menu"
            >
                <button
                    type="button"
                    class="govuk-header__menu-button govuk-js-header-toggle"
                    aria-controls="navigation"
                    aria-label="Show or hide navigation menu"
                    hidden
                >
                    Menu
                </button>

                <ul
                    class="govuk-header__navigation-list"
                    id="navigation"
                >
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
                            <li class="govuk-header__navigation-item">
                                <a
                                    class="govuk-header__link"
                                    href="{{ $link['link'] ?? $link }}"
                                    target="{{ $link['blank'] ?? false === true ? '_blank' : '_self' }}"
                                >
                                    {{ $label }}
                                </a>
                            </li>
                        @endcan
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</header>

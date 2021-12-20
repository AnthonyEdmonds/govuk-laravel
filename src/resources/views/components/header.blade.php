@props([
    'links' => [],
    'logoAlt' => $serviceName,
    'logoRoute' => 'home',
    'logoImage',
    'logoHeight' => 44,
    'serviceName' => null,
])

@php
    $user = Illuminate\Support\Facades\Auth::user();
@endphp

<header
    class="govuk-header"
    role="banner"
    data-module="govuk-header"
>
    <div class="govuk-header__container govuk-width-container">
        <div class="govuk-header__logo">
            <a
                href="{{ route($logoRoute) }}"
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
                    href="{{ route($logoRoute) }}"
                    class="govuk-header__link govuk-header__link--service-name"
                >
                    {{ $serviceName }}
                </a>
            @endisset

            <button
                type="button"
                class="govuk-header__menu-button govuk-js-header-toggle"
                aria-controls="navigation"
                aria-label="Show or hide navigation menu"
            >
                Menu
            </button>

            <nav>
                <ul
                    id="navigation"
                    class="govuk-header__navigation"
                    aria-label="Navigation menu"
                >
                    @if($user !== null)
                        @foreach($links as $label => $link)
                            @can($link['can'] ?? null)
                                <li class="govuk-header__navigation-item">
                                    <a
                                        class="govuk-header__link"
                                        href="{{ route($link['route'] ?? $link) }}"
                                        target="{{ $link['target'] ?? false === true ? '_blank' : '_self' }}"
                                    >
                                        {{ $label }}
                                    </a>
                                </li>
                            @endcan
                        @endforeach
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>

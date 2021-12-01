@php
    use Illuminate\Support\Facades\Auth;

    $nav = config('govuk.navigation');
    $user = Auth::user();
@endphp

<header class="govuk-header" role="banner" data-module="govuk-header">
    <div class="govuk-header__container govuk-width-container">
        <div class="govuk-header__logo">
            <a
                href="{{ route(config('govuk.icon.route')) }}"
                class="govuk-header__link govuk-header__link--homepage"
            >
                <span class="govuk-header__logotype">
                    <img
                        src="{{ asset(config('govuk.icon.asset')) }}"
                        alt="{{ config('govuk.icon.alt') }}"
                        class="govuk-!-padding-2"
                        height="44"
                    />
                </span>
            </a>
        </div>

        <div class="govuk-header__content">
            <a
                href="{{ route(config('govuk.icon.route')) }}"
                class="govuk-header__link govuk-header__link--service-name"
            >
                {{ env('APP_NAME', 'Welcome') }}
            </a>

            <button
                type="button"
                class="govuk-header__menu-button govuk-js-header-toggle"
                aria-controls="navigation"
                aria-label="Show or hide navigation menu"
            >
                Menu
            </button>

            <nav>
                <ul id="navigation" class="govuk-header__navigation " aria-label="Navigation menu">
                    @if($user !== null)
                        @foreach($nav as $label => $details)
                            @can($details['can'] ?? null)
                                <li class="govuk-header__navigation-item">
                                    <a class="govuk-header__link" href="{{ route($details['route']) }}">
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

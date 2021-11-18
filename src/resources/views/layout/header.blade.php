@php
    use Illuminate\Support\Facades\Auth;

    $navigation = [];
    $user = Auth::user();

    if ($user !== null) {
        $navigation['Search'] = route('search.start');

        if ($user->can('access_admin') === true) {
            $navigation['Admin'] = route('admin.dashboard');
        }

        $navigation['Sign Out'] = route('sign-out');
    }
@endphp

<header class="govuk-header" role="banner" data-module="govuk-header">
    <div class="govuk-header__container govuk-width-container">
        <div class="govuk-header__logo">
            <a href="{{ route('dashboard') }}" class="govuk-header__link govuk-header__link--homepage">
                <span class="govuk-header__logotype">
                    <img
                        src="{{ asset('images/logo-white.svg') }}"
                        alt="Network Rail"
                        class="govuk-!-padding-2"
                        height="44"
                    />
                </span>
            </a>
        </div>

        <div class="govuk-header__content">
            <a href="{{ route('dashboard') }}" class="govuk-header__link govuk-header__link--service-name">
                Heatmap Submission System
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
                    @foreach($navigation as $label => $url)
                        <li class="govuk-header__navigation-item">
                            <a class="govuk-header__link" href="{{ $url }}">
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</header>

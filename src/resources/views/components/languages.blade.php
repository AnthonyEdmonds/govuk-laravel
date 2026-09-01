@use(Illuminate\Support\Facades\App)

@props([
    'current' => App::currentLocale(),
    'languages',
    'route',
])

<nav class="govuk-language-navigation" aria-label="Language">
    <ul class="govuk-language-navigation__list">
        @foreach($languages as $code => $label)
            <li class="govuk-language-navigation__list-item">
                @if($code === $current)
                    <span
                        class="govuk-language-navigation__text"
                        aria-current="true"
                        lang="{{ $code }}"
                    >{{ $label }}</span>
                @else
                    <a
                        class="govuk-language-navigation__link"
                        href="{{ route($route, $code) }}"
                        rel="alternate"
                        lang="{{ $code }}"
                        hreflang="{{ $code }}"
                    >{{ $label }}</a>
                @endif
            </li>
        @endforeach
    </ul>
</nav>

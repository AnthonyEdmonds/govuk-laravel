@use(Illuminate\Support\Facades\Auth)
@use(Illuminate\Support\Facades\Route)

@props([
    'currentSection' => null,
    'links' => [],
    'serviceName' => null,
    'serviceRoute' => null,
])

@php
    $formattedLinks = [];

    if ($currentSection === null) {
        $currentSection = Route::current()?->getName() ?? ' ';
    }

    foreach ($links as $label => $link) {
        if (is_string($link) === true) {
            $link = [
                'route' => $link,
            ];
        }

        if (array_key_exists('auth', $link) === true) {
            if (Auth::check() !== $link['auth']) {
                continue;
            }
        }

        if (array_key_exists('can', $link) === true) {
            if (Auth::user()->can($link['can']) !== true) {
                continue;
            }
        }

        if (array_key_exists('section', $link) === false) {
            if (str_contains($link['route'], '.') === true) {
                $index = strpos($link['route'], '.');
                $link['section'] = substr($link['route'], 0, $index);
            } else {
                $link['section'] = $link['route'];
            }
        }

        $link['active'] = str_contains($currentSection, $link['section']) === true;
        $link['classes'] = $link['active'] === true
            ? 'govuk-service-navigation__item govuk-service-navigation__item--active'
            : 'govuk-service-navigation__item';
        $link['route'] = route($link['route']);
        $link['target'] = array_key_exists('blank', $link) === true ? '_blank' : '_self';

        $formattedLinks[$label] = $link;
    }
@endphp

<section
    @if($serviceName !== null)
        aria-label="{{ $serviceName }}"
    @endif
    class="govuk-service-navigation"
    data-module="govuk-service-navigation"
>
    <div class="govuk-width-container">
        <div class="govuk-service-navigation__container">
            @if($serviceName !== null)
                <span class="govuk-service-navigation__service-name">
                    @if($serviceRoute !== null)
                        <a
                            href="{{ route($serviceRoute) }}"
                            class="govuk-service-navigation__link"
                        >{{ $serviceName }}</a>
                    @else
                        <strong>{{ $serviceName }}</strong>
                    @endif
                </span>
            @endif

            <nav aria-label="Menu" class="govuk-service-navigation__wrapper">
                <button
                    aria-controls="navigation"
                    class="govuk-service-navigation__toggle govuk-js-service-navigation-toggle"
                    hidden
                    type="button"
                >Menu</button>

                <ul class="govuk-service-navigation__list" id="navigation">
                    @foreach($formattedLinks as $label => $link)
                        <li class="{{ $link['classes'] }}">
                            <a
                                class="govuk-service-navigation__link"
                                href="{{ $link['route'] }}"
                                target="{{ $link['target'] }}"
                                @if($link['active'] === true)
                                    aria-current="true"
                                @endif
                            >
                                @if($link['active'] === true)
                                    <strong class="govuk-service-navigation__active-fallback">{{ $label }}</strong>
                                @else
                                    {{ $label }}
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</section>

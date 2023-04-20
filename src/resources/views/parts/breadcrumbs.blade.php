@isset($breadcrumbs)
    @php
        $breadcrumbs = array_merge(
            [ config('govuk.home.label') => route(config('govuk.home.route')) ],
            $breadcrumbs
        );
    @endphp

    <x-govuk::breadcrumbs :breadcrumbs="$breadcrumbs" />
@endisset

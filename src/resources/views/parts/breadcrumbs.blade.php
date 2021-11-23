@isset($breadcrumbs)
    @php
        $breadcrumbs = array_merge(
            [ 'Dashboard' => route('dashboard') ],
            $breadcrumbs
        );
    @endphp

    <x-govuk::breadcrumbs :breadcrumbs="$breadcrumbs" />
@endisset

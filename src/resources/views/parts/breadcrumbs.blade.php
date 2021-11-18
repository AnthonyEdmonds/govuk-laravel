@isset($breadcrumbs)
    @php
        $breadcrumbs = array_merge(
            [ 'Dashboard' => route('dashboard') ],
            $breadcrumbs
        );
    @endphp

    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
@endisset

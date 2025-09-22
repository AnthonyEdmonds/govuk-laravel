<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

<main>
    <h1>{{ $title }}</h1>

    <x-form-builder::description :description="$description" />
    <x-form-builder::actions :actions="$actions" />
</main>

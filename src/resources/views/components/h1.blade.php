@props([
    'id' => null,
    'size' => 'l'
])

<h1
    class="govuk-heading-{{ $size }}"
    @if($id !== null) id="{{ $id }}" @endif
>{{ $slot }}</h1>

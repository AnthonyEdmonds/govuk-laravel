@props([
    'id' => null,
    'size' => 's'
])

<h3
    class="govuk-heading-{{ $size }}"
    @if($id !== null) id="{{ $id }}" @endif
>{{ $slot }}</h3>

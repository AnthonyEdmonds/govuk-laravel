@props([
    'id' => null,
    'size' => 'm'
])

<h2
    class="govuk-heading-{{ $size }}"
    @if($id !== null) id="{{ $id }}" @endif
>{{ $slot }}</h2>

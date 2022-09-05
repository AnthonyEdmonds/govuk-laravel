@props([
    'id' => null,
    'size' => 's'
])

<h4
    class="govuk-heading-{{ $size }}"
    @if($id !== null) id="{{ $id }}" @endif
>{{ $slot }}</h4>

@props([
    'bold' => false,
    'id' => null,
    'lead' => false,
    'small' => false,
])

@php
    $classes = 'govuk-body';

    if ($lead === true) {
        $classes .= '-l';
    } elseif ($small === true) {
        $classes .= '-s';
    }

    if ($bold === true) {
        $classes .= ' govuk-!-font-weight-bold';
    }
@endphp

<p
    class="{{ $classes }}"
    @isset($id) id="{{ $id }}" @endisset
>
    {{ $slot }}
</p>

@props([
    'numeric' => false,
    'scope' => 'col',
])

@php
    $cellClass = "govuk-table__header";

    if ($numeric == true) {
        $cellClass .= " govuk-table__header--numeric";
    }
@endphp

<th scope="{{ $scope }}" class="{{ $cellClass }}">
    {!! $slot !!}
</th>

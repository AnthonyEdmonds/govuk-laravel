@props([
    'heading' => false,
    'label' => '',
    'numeric' => false,
])

~~{{ $label }}|{{ $numeric === true ? '1' : '0' }}~~

@if($heading === true)
    <x-table-cell-header :numeric="$numeric" scope="row">{!! $slot !!}</x-table-cell-header>
@else
    <x-table-cell-row :numeric="$numeric">{!! $slot !!}</x-table-cell-row>
@endif

@props([
    'heading' => false,
    'label' => '',
    'numeric' => false,
])

~~{{ $label }}|{{ $numeric === true ? '1' : '0' }}~~

@if($heading === true)
    <x-govuk::table-cell-header :numeric="$numeric" scope="row">{!! $slot !!}</x-govuk::table-cell-header>
@else
    <x-govuk::table-cell-row :numeric="$numeric">{!! $slot !!}</x-govuk::table-cell-row>
@endif

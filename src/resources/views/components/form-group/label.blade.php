@props([
    'id',
    'label',
    'labelSize' => 's',
    'isTitle' => false,
])

@if($isTitle === true)
    <h1 class="govuk-label-wrapper">
@endif

<label class="govuk-label govuk-label--{{ $labelSize }}" for="{{ $id }}">
    {{ $label }}
</label>

@if($isTitle === true)
    </h1>
@endif

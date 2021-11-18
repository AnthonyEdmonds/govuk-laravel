@props([
    'title',
    'size' => 'l',
])

<fieldset class="govuk-fieldset">
    <legend class="govuk-fieldset__legend govuk-fieldset__legend--{{ $size }}">
        <h1 class="govuk-fieldset__heading">
            {{ $title }}
        </h1>
    </legend>

    {!! $slot !!}
</fieldset>

@props([
    'hint' => null,
    'id',
])

@isset($hint)
    <div class="govuk-hint" id="{{ $id }}-hint" >
        {{ $hint }}
    </div>
@endisset

@props([
    'id' => $name,
    'name',
])

@error($name)
    <span class="govuk-error-message" id="{{ $id }}-error" >
        <span class="govuk-visually-hidden">Error: </span>{{ $message }}
    </span>
@enderror

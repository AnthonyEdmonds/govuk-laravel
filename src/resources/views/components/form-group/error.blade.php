@props([
    'id' => $name,
    'name',
])

@error(\AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion::bracketsToDots($name))
    <p class="govuk-error-message" id="{{ $id }}-error" >
        <span class="govuk-visually-hidden">Error: </span>{{ $message }}
    </p>
@enderror

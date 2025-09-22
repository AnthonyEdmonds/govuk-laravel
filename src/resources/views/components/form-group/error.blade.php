@props([
    'id' => $name,
    'name',
])

@use(AnthonyEdmonds\GovukLaravel\Helpers\GovukPage)

@error(GovukPage::bracketsToDots($name))
    <p class="govuk-error-message" id="{{ $id }}-error" >
        <span class="govuk-visually-hidden">Error: </span>{{ $message }}
    </p>
@enderror

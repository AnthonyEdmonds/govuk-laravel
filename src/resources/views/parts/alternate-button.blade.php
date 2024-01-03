@if($alternateButtonLabel !== null)
    <x-govuk::button
        form-action="{{ $action }}?alt=true"
        prevent-double-click
    >{{ $alternateButtonLabel }}</x-govuk::button>
@endif

@props([
    'count' => null,
    'id',
    'threshold' => null,
    'words' => null,
])

<div
    class="govuk-character-count"
    data-module="govuk-character-count"

    @if($threshold !== null)
        data-threshold="{{ $threshold }}"
    @endif

    @if($words !== null)
        data-maxwords="{{ $words }}"
    @else
        data-maxlength="{{ $count }}"
    @endif
>
    {{ $slot }}

    <div
        id="{{ $id }}-info"
        class="govuk-hint govuk-character-count__message "
    ></div>
</div>

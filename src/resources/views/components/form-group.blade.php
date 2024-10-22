@props([
    'count' => null,
    'dataModule' => null,
    'id' => $name,
    'name',
    'password' => false,
    'threshold' => null,
    'words' => null,
])

@php
    $groupClasses = 'govuk-form-group';

    if ($errors->has(\AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion::bracketsToDots($name)) === true) {
        $groupClasses .= ' govuk-form-group--error';
    }

    if ($password === true) {
        $groupClasses .= ' govuk-password-input';
    }

    $hasCount = $count !== null || $words !== null;

    if ($hasCount === true) {
        $groupClasses .= ' govuk-character-count';
        $dataModule = 'govuk-character-count';
    }
@endphp

<div
    class="{{ $groupClasses }}"

    @if($dataModule !== null)
        data-module="{{ $dataModule }}"
    @endif

    @if($hasCount === true)
        @if($threshold !== null)
            data-threshold="{{ $threshold }}"
        @endif

        @if($words !== null)
            data-maxwords="{{ $words }}"
        @else
            data-maxlength="{{ $count }}"
        @endif
    @endif
>
    {!! $slot !!}

    @if($hasCount === true)
        <div
            id="{{ $id }}-info"
            class="govuk-hint govuk-character-count__message"
        ></div>
    @endif
</div>

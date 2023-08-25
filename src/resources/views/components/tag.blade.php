@props([
    'colour' => 'blue',
    'id' => null,
    'label',
    'phase' => false,
    'taskList' => false,
])

@php
    $tagClasses = "govuk-tag govuk-tag--{$colour}";

    if ($phase === true) {
        $tagClasses .= ' govuk-phase-banner__content__tag';
    }
    
    if ($taskList === true) {
        $tagClasses .= ' app-task-list__tag';
    }
@endphp

<strong
    class="{{ $tagClasses }}"
    @if($id !== null)
        id="{{ $id }}"
    @endif
>
    {{ $label }}
</strong>

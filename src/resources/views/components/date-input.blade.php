@props([
    'autocomplete' => 'on',
    'hint' => null,
    'id' => $name,
    'isTitle' => false,
    'label',
    'labelSize' => 'l',
    'name',
    'noDay' => false,
    'noMonth' => false,
    'noYear' => false,
])

@php
    switch ($autocomplete) {
        case 'bday':
        case 'bday-day':
        case 'bday-month':
        case 'bday-year':
            $autocompleteDay = 'bday-day';
            $autocompleteMonth = 'bday-month';
            $autocompleteYear = 'bday-year';
            break;

        case 'cc-exp':
        case 'cc-exp-month':
        case 'cc-exp-year':
            $noDay = true;
            $autocompleteDay = '';
            $autocompleteMonth = 'cc-exp-month';
            $autocompleteYear = 'cc-exp-year';
            break;

        default:
            $autocompleteDay = $autocomplete;
            $autocompleteMonth = $autocomplete;
            $autocompleteYear = $autocomplete;
    }
@endphp

<x-govuk::form-group>
    <x-govuk::fieldset
        :id="$id"
        :is-title="$isTitle"
        :label="$label"
        :labelSize="$labelSize"
    >
        <x-govuk::form-group.hint :id="$id" :hint="$hint" />
        <x-govuk::form-group.error :id="$id" :name="$name" />

        <div class="govuk-date-input" id="{{ $id }}">
            @if($noDay !== true)
                <div class="govuk-date-input__item">
                    <div class="govuk-form-group">
                        <label
                            class="govuk-label govuk-date-input__label"
                            for="{{ $id }}-day"
                        >Day</label>
                        <input
                            class="govuk-input govuk-date-input__input govuk-input--width-2"
                            id="{{ $id }}-day"
                            name="{{ $name }}-day"
                            type="text"
                            autocomplete="{{ $autocompleteDay }}"
                            pattern="[0-9]*"
                            inputmode="numeric"
                        />
                    </div>
                </div>
            @endif

            @if($noMonth !== true)
                <div class="govuk-date-input__item">
                    <div class="govuk-form-group">
                        <label
                            class="govuk-label govuk-date-input__label"
                            for="{{ $id }}-month"
                        >Month</label>
                        <input
                            class="govuk-input govuk-date-input__input govuk-input--width-2"
                            id="{{ $id }}-month"
                            name="{{ $name }}-month"
                            type="text"
                            autocomplete="{{ $autocompleteMonth }}"
                            pattern="[0-9]*"
                            inputmode="numeric"
                        />
                    </div>
                </div>
            @endif

            @if($noYear !== true)
                <div class="govuk-date-input__item">
                    <div class="govuk-form-group">
                        <label
                            class="govuk-label govuk-date-input__label"
                            for="{{ $id }}-year"
                        >Year</label>
                        <input
                            class="govuk-input govuk-date-input__input govuk-input--width-4"
                            id="{{ $id }}-year"
                            name="{{ $name }}-year"
                            type="text"
                            autocomplete="{{ $autocompleteYear }}"
                            pattern="[0-9]*"
                            inputmode="numeric"
                        />
                    </div>
                </div>
            @endif
        </div>
    </x-govuk::fieldset>
</x-govuk::form-group>
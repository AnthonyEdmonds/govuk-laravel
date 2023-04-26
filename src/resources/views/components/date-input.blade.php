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
    'value' => [],
])

@php
    $dayName = "$name-day";
    $monthName = "$name-month";
    $yearName = "$name-year";

    $dayId = "$id-day";
    $monthId = "$id-month";
    $yearId = "$id-year";

    use Carbon\Carbon;
    
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

    if (is_a($value, Carbon::class) === true) {
        $dayValue = $value->day;
        $monthValue = $value->month;
        $yearValue = $value->year;
    } else {
        $dayValue = $value['day'] ?? null;
        $monthValue = $value['month'] ?? null;
        $yearValue = $value['year'] ?? null;
    }

    $values = [
        'day' => old($dayName, $dayValue),
        'month' => old($monthName, $monthValue),
        'year' => old($yearName, $yearValue),
    ];
@endphp

<x-govuk::form-group :name="$name">
    <x-govuk::fieldset
        :id="$id"
        :is-title="$isTitle"
        :label="$label"
        :labelSize="$labelSize"
    >
        <x-govuk::form-group.hint :id="$id" :hint="$hint" />
        <x-govuk::form-group.error :id="$id" :name="$name" />
        <x-govuk::hidden-input :id="$id" :name="$name" value="1" />

        <div class="govuk-date-input" id="{{ $id }}">
            @if($noDay !== true)
                <div class="govuk-date-input__item">
                    <div class="govuk-form-group">
                        <label
                            class="govuk-label govuk-date-input__label"
                            for="{{ $dayId }}"
                        >Day</label>
                        <input
                            class="govuk-input govuk-date-input__input govuk-input--width-2"
                            id="{{ $dayId }}"
                            name="{{ $dayName }}"
                            type="text"
                            autocomplete="{{ $autocompleteDay }}"
                            inputmode="numeric"
                            value="{{ $values['day'] ?? '' }}"
                        />
                    </div>
                </div>
            @endif

            @if($noMonth !== true)
                <div class="govuk-date-input__item">
                    <div class="govuk-form-group">
                        <label
                            class="govuk-label govuk-date-input__label"
                            for="{{ $monthId }}"
                        >Month</label>
                        <input
                            class="govuk-input govuk-date-input__input govuk-input--width-2"
                            id="{{ $monthId }}"
                            name="{{ $monthName }}"
                            type="text"
                            autocomplete="{{ $autocompleteMonth }}"
                            inputmode="numeric"
                            value="{{ $values['month'] ?? '' }}"
                        />
                    </div>
                </div>
            @endif

            @if($noYear !== true)
                <div class="govuk-date-input__item">
                    <div class="govuk-form-group">
                        <label
                            class="govuk-label govuk-date-input__label"
                            for="{{ $yearId }}"
                        >Year</label>
                        <input
                            class="govuk-input govuk-date-input__input govuk-input--width-4"
                            id="{{ $yearId }}"
                            name="{{ $yearName }}"
                            type="text"
                            autocomplete="{{ $autocompleteYear }}"
                            inputmode="numeric"
                            value="{{ $values['year'] ?? '' }}"
                        />
                    </div>
                </div>
            @endif
        </div>
    </x-govuk::fieldset>
</x-govuk::form-group>

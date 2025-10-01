# Date Input

Create a series of inline `input` elements for entering a date, with toggleable year, month, and day inputs.

```html
<x-govuk::date-input
    autocomplete="bday"
    hint="Enter the day, month, and year"
    id="birthday"
    is-title
    label="When is your birthday?"
    labelSize="xl"
    name="birthday"
    no-day
    no-month
    no-year
    :values="$values"
/>
```

A hidden input is also submitted with the base `name` and a `true` value, for easier validation using the special date rules.

## Props

| Name         | Type           | Default  | Description                                            |
|--------------|----------------|----------|--------------------------------------------------------|
| autocomplete | string         | on       | Whether the date inputs should be automatically filled |
| hint         | string         | null     | A description of the input                             |
| id           | string         | $name    | The ID of the input                                    |
| isTitle      | bool           | false    | Whether the label is also the page title               |
| label        | string         | Required | The label for the form group                           |
| labelSize    | string         | null     | How large the label should be                          |
| name         | string         | Required | The name of the input                                  |
| noDay        | bool           | false    | Hide the day input                                     |
| noMonth      | bool           | false    | Hide the month input                                   |
| noYear       | bool           | false    | Hide the year input                                    |
| values       | Carbon\| array | []       | The current values of the inputs                       |

### Autocomplete

The most common autocomplete modes are `bday` and `cc-exp`, with a suffix for day, month, and year.

This component will automatically add the appropriate suffix to each input.

### ID and Name

This component will automatically suffix the `id` and `name` of each input with `-day`. `-month`, and `-year`.

### Values

You may provide the current values of the inputs with a Carbon instance or a keyed array:

```php
[
    'day' => 31,
    'month' => 12,
    'year' => 2021,
]
```

## Validation

A special [rule](../rules.md) is provided for validating dates submitted in multiple parts.

Include the OnDate, AfterDate, BeforeDate, OnOrAfterDate, or OnOrBeforeDate rule on the main `name` validation.

```php
[
    'birth' => [
        'required',
        Rule::onOrBeforeDate(Carbon::now()),
    ],
    'birth-day' => [
        // Not here
    ]
]
```

## Parsing

A helper is provided for parsing dates from GOV.UK style inputs.

```php
$date = GovukDate::parse($formRequest, $dateKey);

$dateWithTime = GovukDate::parse(
    [
        'birth-day' => 31,
        'birth-month' => 10,
        'birth-year' => 2024,
        'time' => '15:10',
    ],
    'birth',
    'time',
);
```

Provide either a `FormRequest` or an `array` of values with the date key, to receive a usable `Carbon` instance.

The time key may also be provided if being used, otherwise the time will be set to midnight.

## Also see

* [checkboxes](checkboxes.md)
* [fieldset](fieldset.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [hidden-input](hidden-input.md)
* [password](password.md)
* [radios](radios.md)
* [select](select.md)
* [text-input](text-input.md)
* [textarea](textarea.md)

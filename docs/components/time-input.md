# Date Input

The GOV.UK Design System does not currently have an official Time input component. This implementation is based on their [ongoing discussions](https://github.com/alphagov/govuk-design-system-backlog/issues/173).

Create an `input` element for entering a time.

```html
<x-govuk::time-input
    hint="For example, 9am or 14:30 - enter 12pm for midday"
    id="starts_at"
    is-title
    label="What time does this start?"
    labelSize="xl"
    name="starts_at"
    :value="$value"
/>
```

## Props

| Name      | Type           | Default  | Description                              |
|-----------|----------------|----------|------------------------------------------|
| hint      | string         | null     | A description of the input               |
| id        | string         | $name    | The ID of the input                      |
| isTitle   | bool           | false    | Whether the label is also the page title |
| label     | string         | Required | The label for the form group             |
| labelSize | string         | l        | How large the label should be            |
| name      | string         | Required | The name of the input                    |
| value     | Carbon\|string | null     | The current value of the inputs          |

## Rules

A special [rule](../rules.md) is provided for validating times in multiple formats.

```php
[
    'starts_at' => [
        'required',
        Rule::time(),
    ],
]
```

## Parsing

A helper is provided for parsing times from GOV.UK style inputs.

```php
$time = GovukDate::parseTime($formRequest, $timeKey);

$time = GovukDate::parseTime(
    [
        'time' => '15:10',
    ],
    'time',
);
```

Provide either a `FormRequest` or an `array` of values with the time key, to receive a usable `Carbon` instance.

## Also see

* [checkboxes](checkboxes.md)
* [date-input](date-input.md)
* [fieldset](fieldset.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [hidden-input](hidden-input.md)
* [password](password.md)
* [radios](radios.md)
* [select](select.md)
* [text-input](text-input.md)
* [textarea](textarea.md)

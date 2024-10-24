# Form Group

Wrap an `input` inside a `form-group` to provide adequate spacing and error visibility. 

```html
<x-govuk::form-group
    count="50"
    data-module="my_data_module"
    id="input_id"
    name="input_name"
    password
    threshold="35"
    words="12"
>
    // An input...
</x-govuk::form-group>
```

All `input` components provided by GOV.UK Laravel are pre-wrapped.

## Props

| Name       | Type   | Default  | Description                                                                   |
|------------|--------|----------|-------------------------------------------------------------------------------|
| count      | int    | null     | Show a character limit counter equal to `count`                               |
| dataModule | string | null     | The value of the `data-module`  attribute                                     |
| id         | string | $name    | The ID of the textarea                                                        |
| name       | string | Required | The `name` of the wrapped input element                                       |
| password   | bool   | false    | Whether this FormGroup contains a password input                              |
| threshold  | int    | null     | Show the counter only after the threshold percentage is reached, such as `50` |
| words      | int    | null     | Show a word limit counter equal to `words`                                    |

## Counter

The counter is used with a `textarea` component, and should be set directly on that component instead of the `form-group`.

## Subcomponents

* form-group.error
* form-group.hint
* form-group.label

## Also see

* [checkboxes](checkboxes.md)
* [date-input](date-input.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [hidden-input](hidden-input.md)
* [password](password.md)
* [radios](radios.md)
* [select](select.md)
* [text-input](text-input.md)
* [textarea](textarea.md)
* [time-input](time-input.md)

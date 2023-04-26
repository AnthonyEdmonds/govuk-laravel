# Fieldset

Group related `input` elements together with a label.

```html
<x-govuk::fieldset
    id="my-id"
    is-title
    label="What is your address?"
    label-size="l"
>
    // Inputs
</x-govuk::fieldset>
```

Both `checkboxes` and `radios` come with a `fieldset` included.

## Props

| Name       | Type   | Default  | Description |
| ---------- | ------ | -------- | ----------- |
| isTitle    | bool   | false    | Whether the label is the heading for the page |
| label      | string | Required | A description of what the group of inputs is asking |
| labelSize  | string | l        | How large to make the label |
| id         | string | Required | The ID of the input |

## Also see

* [checkboxes](checkboxes.md)
* [date-input](date-input.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [hidden-input](hidden-input.md)
* [radios](radios.md)
* [select](select.md)
* [text-input](text-input.md)
* [textarea](textarea.md)
* [time-input](time-input.md)

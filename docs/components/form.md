# Form

Create a form element for any number of inputs:

```html
<x-govuk::form
    action="{{ route('submit-route') }}"
    method="put"
>
    // Inputs...
    // Submit button...
</x-govuk::form>
```

The `@csrf` and `@method` Laravel components are automatically included when the `method` prop is set to anything other than `get`.

## Props

| Name   | Type   | Default  | Description |
| ------ | ------ | -------- | ----------- |
| action | string | Required | Where to submit the form to |
| method | string | post     | Which HTTP method to use when sending the form |

## Also see

* [button](button.md)
* [checkboxes](checkboxes.md)
* [date-input](date-input.md)
* [fieldset](fieldset.md)
* [file-upload](file-upload.md)
* [hidden-input](hidden-input.md)
* [radios](radios.md)
* [search-bar](search-bar.md)
* [select](select.md)
* [text-input](text-input.md)
* [textarea](textarea.md)

# Error Summary

Show an overview of every validation error encountered when submitting a page.

```html
<x-govuk::error-summary
    :messages="$messages"
/>
```

An `error-summary` is provided as a part of the default page template.

## Props

| Name | Type | Default | Description |
| ---- | ---- | ------- | ----------- |
| messages | array | Required | A keyed array of messages |

### Messages

The array being passed into this component should be a keyed array, where the key is the `id` of the `input` that failed validation, and the value is the validation message itself.

## Also see

* [errors (part)](../parts/errors.md)

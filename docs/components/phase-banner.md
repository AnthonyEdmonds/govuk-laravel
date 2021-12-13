# Phase Banner

Show a banner that displays a piece of information that the user should be aware of.

```html
<x-govuk::phase-banner
    colour="red"
    phase="Online"
>
    // Phase description
</x-govuk::phase-banner>
```

The phase description content does not need to be wrapped in an HTML tag, but can include them.

## Props

| Name   | Type   | Default  | Description |
| ------ | ------ | -------- | ----------- |
| colour | string | blue     | The colour of the tag in the banner |
| phase  | string | Required | The label of the tag in the banner |

## Also see

* [tag](tag.md)

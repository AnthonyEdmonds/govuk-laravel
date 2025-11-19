# Ordered List

Create an `ol` element, with optional spacing.

```html
<x-govuk::ol
    spaced
    type="number"
>
    <li>My list item</li>
    // More list items...
</x-govuk::ol>
```

## Props

| Name   | Type   | Default | Description                                |
|--------|--------|---------|--------------------------------------------|
| spaced | bool   | false   | Whether list items should have extra space |
| type   | string | number  | The style of list bullets                  |

### Type

The type may be any of the following:

* lower-alpha
* lower-roman
* number
* upper-roman

## Also see
* [ul](ul.md)

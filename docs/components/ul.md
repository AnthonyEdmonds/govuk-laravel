# Unordered List

Create a `ul` element, with optional spacing and bullets.

```html
<x-govuk::ul
    bulleted
    spaced
    type="bullet"
>
    <li>My list item</li>
    // More list items...
</x-govuk::ul>
```

## Props

| Name     | Type   | Default | Description                                |
|----------|--------|---------|--------------------------------------------|
| bulleted | bool   | false   | Whether list items should have bullets     |
| spaced   | bool   | false   | Whether list items should have extra space |
| type     | string | bullet  | The style of list bullets                  |

### Type

The type may be any of the following:

* bullet
* disc
* square

## Also see
* [ol](ol.md)

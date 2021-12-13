# Unordered List

Create a `ul` element, with optional spacing and bullets.

```html
<x-govuk::ul
    bulleted
    spaced
>
    <li>My list item</li>
    // More list items...
</x-govuk::ul>
```

## Props

| Name     | Type | Default | Description |
| -------- | ---- | ------- | ----------- |
| bulleted | bool | false   | Whether list items should have bullets |
| spaced   | bool | false   | Whether list items should have extra space |

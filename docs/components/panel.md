# Panel

Create a highly visible confirmation message that replaces the page `h1` title.

```html
<x-govuk::panel
    title="Application complete"
>
    Your reference number
    <br/><strong>HDJ2123F</strong>
</x-govuk::panel>
```

You may pass content into the `panel` without wrapping it.

## Props

| Name  | Type   | Default  | Description                     |
|-------|--------|----------|---------------------------------|
| title | string | Required | The title of the panel and page |

# Skip Link

Create an invisible link for screen readers that allows users to jump straight to the main content of the page.

```html
<x-govuk::skip-link
    anchor="content"
    label="Skip to main content"
/>
```

A `skip-link` is provided on the `page` template.

## Props

| Name   | Type   | Default              | Description |
| ------ | ------ | -------------------- | ----------- |
| anchor | string | content              | The ID of the `main` page element |
| label  | string | Skip to main content | The descriptive label for screen readers | 

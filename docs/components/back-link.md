# Back Link

Provide a simple `back` navigation link in lieu of a breadcrumb, useful for forms and pages with a linear flow.

```html
<x-govuk::back-link
    href="{{ route('my-route') }}"
    inverted
/>
```

## Props

| Name     | Type    | Default  | Description                                |
|----------|---------|----------|--------------------------------------------|
| href     | string  | Required | The URL to navigate to                     |
| inverted | bool    | false    | Whether the link colour should be inverted |

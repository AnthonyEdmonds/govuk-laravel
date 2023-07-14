# Breadcrumbs

Create a list of links that lead back to home, or a higher level:

```html
<x-govuk::breadcrumbs
    :breadcrumbs="[
        'My Label' => route('my-route'),
        ... 
    ]"
    inverted
/>
```

## Props

| Name        | Type   | Default  | Description                                                         |
|-------------|--------|----------|---------------------------------------------------------------------|
| breadcrumbs | array  | Required | A keyed array, where the key is the label, and the value is the URL |
| inverted    | bool   | false    | Whether the breadcrumbs colour should be inverted                   |

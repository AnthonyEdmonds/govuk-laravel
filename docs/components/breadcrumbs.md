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

| Name        | Type   | Default  | Description                                       |
|-------------|--------|----------|---------------------------------------------------|
| breadcrumbs | array  | Required | An array of items                                 |
| inverted    | bool   | false    | Whether the breadcrumbs colour should be inverted |

### Breadcrumbs

You may pass items in one of two formats, depending on whether they are links or static text:

```php
[
    'This is a link' => route('my-route'),
    'This is not a link',
]
```

* Passing a key-value pair will create a clickable link
* Passing only a value will create static text

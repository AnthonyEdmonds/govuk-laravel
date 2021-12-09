# Summary List

Create a descriptive list of keys and values.

Particularly useful for summarising the details held within a model, or a User's answers to a form.

Actions can be assigned to each row to allow editing, or deeper navigation.

```html
<x-govuk::summary-list
    :list="$myList"
    no-borders
/>
```

## Props

| Name       | Type  | Default  | Description |
| ---------- | ----- | -------- | ----------- |
| list       | array | Required | A keyed array |
| no-borders | bool  | false    | Whether to hide borders between rows |

### List

The summary list must be provided as a keyed array where the index key is the label of each entry, and the details are the value:

```php
[
    'My label' => 'A value',
    'Another label' => 'Another value',
]
```

If you need to provide multiple values, pass the values as an array:
```php
[
    'My label' => [
        'A value',
        'Another value',
    ],
]
```

If you want to use actions, provide an array with a `value` key for the detail, and an `action` key with a `label` and `route` name:

```php
[
    'My label' => [
        'value' => 'A value',
        'action' => [
            'label' => 'Action label',
            'route' => 'a.route.name',
        ],
    ],
]
```

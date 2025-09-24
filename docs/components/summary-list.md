# Summary List

Create a descriptive list of keys and values, with optional actions.

Particularly useful for summarising the details held within a model, or a User's answers to a form.

```html
<x-govuk::summary-list
    :list="$myList"
    no-borders
/>
```

## Props

| Name       | Type  | Default  | Description                          |
| ---------- | ----- | -------- |--------------------------------------|
| list       | array | Required | A keyed array                        |
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

You may also pass the `label` as an array key:

```php
[
    [
        'label' => 'My label',
        'value' => [
            'A value',
            'Another value',
        ],
    ],
]
```

If you want to use actions, provide an array with a `value` key for the detail, and an `action` key with a `label` and `route` name:

```php
[
    'My label' => [
        'value' => 'A value',
        'action' => [
            'label' => 'Change',
            'hidden' => 'name', // Optional, to describe the action for screen readers
            'url' => 'https://my.com/route',
        ],
    ],
]
```

You may also set the action to use a `button` element styled as a link, if you need to submit a non-GET request:

```php
[
    'My label' => [
        'value' => 'A value',
        'action' => [
            'label' => 'Change',
            'hidden' => 'name',
            'url' => 'https://my.com/route',
            'asButton' => true,
            'method' => 'post', // Optional, defaults to post
        ],
    ],
]
```

## Subcomponents

* summary-list.item

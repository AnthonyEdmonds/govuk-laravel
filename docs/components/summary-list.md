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

The summary list can be provided either as a keyed array, where the index key is the label of each entry, or an array of arrays:

```php
[
    'My label' => 'A value',
    'Another label' => 'Another value',
    [
        'label' => 'My label',
        'value' => 'A value',
    ],
]
```

| Name     | Type          | Default  | Description                                           |
|----------|---------------|----------|-------------------------------------------------------|
| actions  | array         | []       | Any actions the user can take in relation to the item |
| colour   | string        | null     | The colour of the status, when provided               |
| label    | string        | null     | A heading for the item, such as "Name"                |
| status   | string        | null     | The status of the item                                |
| value    | string\|array | Required | The value of the item, or an array of values          |

If you want to provide multiple values, pass the values as an array:

```php
[
    'My label' => [
        'A value',
        'Another value',
    ],
    [
        'colour' => 'blue',
        'label' => 'My label',
        'status' => 'Incomplete',
        'value' => [
            'A value',
            'Another value',
        ],
    ],
]
```

#### Actions

If you want to use actions, provide an array containing at least one action:

```php
[
    'My label' => [
        'value' => 'A value',
        'actions' => [
            [
                'label' => 'Change',
                'url' => 'https://my.com/route',
            ],
        ],
    ],
]
```

Each action must have at least the `label` and `url` keys.

| Name     | Type   | Default  | Description                                            |
|----------|--------|----------|--------------------------------------------------------|
| asButton | bool   | false    | Display the action as a button                         |
| hidden   | string | null     | Hidden text placed after the `label` for screenreaders |
| label    | string | Required | A descriptive word for the action, such as "Change"    |
| method   | string | POST     | Which form method to use, when `asButton` is enabled   |
| url      | string | Required | Where the action should redirect users to              |

You may also set the action to use a `button` element styled as a link, if you need to submit a non-GET request:

```php
[
    'My label' => [
        'value' => 'A value',
        'action' => [
            'asButton' => true,
            'hidden' => 'name',
            'label' => 'Change',
            'method' => 'post',
            'url' => 'https://my.com/route',
        ],
    ],
]
```

## Subcomponents

* summary-list.item

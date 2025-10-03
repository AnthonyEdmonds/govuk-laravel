# Summary Card

Create a distinct list of information, complete with title and optional actions.

Useful for showing several summary lists on the same page with distinct formatting.

```html
<x-govuk::summary-card
    :actions="$myActions"
    id="my-id"
    :list="$myList"
    no-borders
    status="Incomplete"
    status-colour="blue"
    title="My Summary Card"
/>
```

## Props

| Name          | Type   | Default  | Description                                       |
|---------------|--------|----------|---------------------------------------------------|
| actions       | array  | []       | One or more actions to be shown next to the title |
| id            | string | null     | An unique ID for the summary card                 |
| list          | array  | Required | A keyed array                                     |
| no-borders    | bool   | false    | Whether to hide borders between rows              |
| status        | string | null     | A status to show against the card                 |
| status-colour | string | null     | The colour of the status, when provided           |
| title         | string | Required | The <h2> title for the card                       |

### Actions

Actions may be provided as a key-value pair of labels and URLs:

```php
[
    'My label' => 'https://my-link.com',
    'Another label' => route('index.show'),
]
```

You may provide additional hidden wording on the label by providing a keyed array with the `url` and `hidden` keys:

```php
[
    'Delete' => [
        'hidden' => 'record #1234',
        'url' => 'https://my-link.com', 
    ],
]
```

### List

As per the [summary-list](summary-list.md) component.

## Subcomponents

* summary-list

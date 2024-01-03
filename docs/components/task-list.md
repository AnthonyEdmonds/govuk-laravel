# Task List

Create a task list component to show a multiple-stage form or process.

```html
<x-govuk::task-list
    :tasks="$tasks"
    title="Check before you start"
/>
```

You may use multiple task lists on a page, each with a unique title.

## Props

| Name  | Type   | Default  | Description                       |
|-------|--------|----------|-----------------------------------|
| tasks | array  | Required | An array of tasks to be completed |
| title | string | Required | The title of the task list        |

### Tasks

The task list must be provided as a keyed array, where the key is the label and the value is an array of details.

```php
[
    'Task label' => [
        'colour' => 'blue',
        'hint' => 'More information'
        'id' => 'my-id',
        'status' => 'Completed',
        'url' => route('my-route'),
    ],
    ...
];
```

You may include any number of tasks.

Each task may have the following keys:

| Name   | Type   | Default  | Description                           |
|--------|--------|----------|---------------------------------------|
| colour | string | null     | The colour of the task's status tag   |
| hint   | string | null     | Supporting information about the task |
| id     | string | null     | The ID of the task                    |
| status | string | Required | The status of the task                |
| url    | string | null     | A link to the task                    |

Each task will be assigned an `id` based on a snake-case version of its `label`, if not specified.

#### Colour and Status

The status of each task should correspond to one of the following:

* Cannot start yet
* Not started
* In progress
* Completed

These statuses and their colours are available in the `TaskList` helper class.

The component will automatically add the relevant `colour` to each tag when using these statuses.

#### URL

Tasks with a null `url` will not show a link.

Tasks in a "Cannot start yet" status should either not have a `url` or be set to null.

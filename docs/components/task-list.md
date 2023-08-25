# Task List

Create a task list component to show a multiple-stage form or process.

```html
<x-govuk::task-list :list="$list" />
```

## Props

| Name | Type  | Default  | Description                                    |
|------|-------|----------|------------------------------------------------|
| list | array | Required | An array of sections and tasks to be completed |

### List

The task list must be provided as a keyed array, where the lowest level keys are the section titles, and the next level keys are the tasks.

```php
$list = [
    'Section title' => [
        'Task label' => [
            'status' => 'Completed',
            'url' => route('my-route'),
        ],
        ...
    ],
    ...
];
```

You may include any number of sections and tasks.

Each task must have a `status` and `url`.

The component will automatically add the relevant `colour` to each task.

Each task will also get an `id` based on a snake-case version of its `label`.

#### Status

The status of each task must correspond to one of the following:

* Cannot start yet
* Not started
* In progress
* Completed

These statuses and their colours are available in the `TaskList` helper class.

#### URL

The url may be either a `string` or `null`.

A link will not be presented when the task status is "Cannot start yet" or the URL is `null`.

## Also see

* [button](button.md)
* [footer](footer.md)

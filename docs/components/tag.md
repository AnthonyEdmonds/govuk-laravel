# Tag

Create a coloured box with a label, ideal for statuses.

```html
<x-govuk::tag
    colour="blue"
    id="my-tag"
    label="Open"
    phase
    task-list
/>
```

## Props

| Name     | Type   | Default  | Description                                  |
|----------|--------|----------|----------------------------------------------|
| colour   | string | blue     | Any GOV.UK colour                            |
| id       | string | null     | The ID of the tag                            |
| label    | string | Required | The tag label                                |
| phase    | bool   | false    | Whether this tag is part of a `phase-banner` |
| taskList | bool   | false    | Whether this tag is part of a `task-list`    |

## Also see

* [phase-banner](phase-banner.md)
* [task-list](task-list.md)

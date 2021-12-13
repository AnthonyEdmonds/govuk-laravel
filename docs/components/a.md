# a

Create an `<a>` tag with the appropriate classes already applied.

```html
<x-govuk::a
    as-button
    href="{{ route('my-route') }}"
    target="_blank"
>My Link</x-govuk::a>
```

When setting the target as `_blank`, be sure to include an indicator that the link will open in a new window in the link description. 

## Props

| Name     | Type   | Default  | Description |
| -------- | ------ | -------- | ----------- |
| asButton | bool   | false    | Style the link as a `<button>` element |
| href     | string | Required | Where the tag should link to |
| target   | string | _self    | Which window the link should open in |

## Also see

* [button](button.md)

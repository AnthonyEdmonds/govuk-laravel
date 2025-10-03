# Anchor

Create an `<a>` tag with the appropriate classes already applied.

```html
<x-govuk::a
    aria-describedby="my-id"
    as-button
    as-start-button
    footer
    href="{{ route('my-route') }}"
    image
    inverted
    secondary
    target="_blank"
>My Link</x-govuk::a>
```

When setting the target as `_blank`, be sure to include an indicator that the link will open in a new window in the link description. 

## Props

| Name             | Type   | Default  | Description                                       |
|------------------|--------|----------|---------------------------------------------------|
| aria-describedby | string | null     | The ID of an element with the aria description in |
| asButton         | bool   | false    | Style the link as a `<button>` element            |
| asStartButton    | bool   | false    | Style the button as "start"                       |
| footer           | bool   | false    | Whether the link is in a `footer` component       |
| href             | string | Required | Where the tag should link to                      |
| image            | bool   | false    | Whether the link is wrapping an image             |
| inverted         | bool   | false    | Whether the link colour should be inverted        |
| secondary        | bool   | false    | Style the button as "secondary"                   |
| target           | string | _self    | Which window the link should open in              |

### Image

When the link is wrapping an image by itself, adding the `image` flag will apply the correct styling.

### Secondary

This can only be used for links which have `asButton` enabled.

## Also see

* [button](button.md)
* [footer](footer.md)

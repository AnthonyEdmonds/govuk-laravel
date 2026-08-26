# Panel

Create a highly visible confirmation message that replaces the page `h1` title.

```html
<x-govuk::panel
    title="Application complete"
    interruption
    confirm-label="Confirm"
    confirm-url="{{ route('confirm') }}"
    cancel-label="Cancel"
    cancel-url="{{ route('cancel') }}"
>
    Your reference number
    <br/><strong>HDJ2123F</strong>
</x-govuk::panel>
```

You may pass content into the `panel` without wrapping it.

## Props

| Name         | Type     | Default  | Description                                              |
|--------------|----------|----------|----------------------------------------------------------|
| title        | string   | Required | The title of the panel and page                          |
| interruption | bool     | false    | Whether the panel should be formatted as an interruption |
| confirmLabel | string   | null     | The label for the primary interruption action            |
| confirmUrl   | string   | null     | The URL for the primary interruption action              |
| cancelLabel  | string   | null     | The label for the secondary interruption action          |
| cancelUrl    | string   | null     | The URL for the secondary interruption action            |

## Interruption actions

Users are required to interact with an interruption panel.

To achieve this, you may use the confirm and cancel actions.

You may provide the confirm action by itself, if cancel is not needed.

You can technically use the actions on a non-interruption panel, though this is not suggested by GOV.UK.

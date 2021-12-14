# Search Bar

Create an input complete with a form and submit button, styled with an icon.

```html
<x-govuk::search-bar
    action="{{ route('search-route') }}"
    hint="Enter a few words"
    id="search-id"
    label="What are you looking for?"
    labelSize="m"
    method="get"
    name="search_term"
    value="Potato"
/>
```

You may pass any additional search inputs into the provided slot.

```html
<x-govuk::search-bar
    action="{{ route('search-route') }}"
    name="search_term"
>
    <x-govuk::select
        label="What type of thing are you looking for?"
        name="search_type"
        :options="$options"
    />
</x-govuk::search-bar>
```

## Props

| Name      | Type   | Default  | Description |
| --------- | ------ | -------- | ----------- |
| action    | string | Required | The endpoint to submit searches to |
| hint      | string | null     | A hint for the search input |
| id        | string | $name    | The ID of the search input |
| label     | string | Search   | The label of the search input |
| labelSize | string | m        | How large the label should be |
| method    | string | get      | Which method to submit searches with |
| name      | string | Required | The name of the search input |
| value     | string | null     | The current value of the search input |

## Also see

* [button](button.md)
* [checkboxes](checkboxes.md)
* [fieldset](fieldset.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [hidden-input](hidden-input.md)
* [radios](radios.md)
* [select](select.md)
* [text-input](text-input.md)
* [textarea](textarea.md)

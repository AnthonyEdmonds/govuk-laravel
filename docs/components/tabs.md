# Tabs (and Tab Panels)

Create a horizontal set of tabs that the user can switch between.

```html
<x-govuk::tabs
    title="My tabs"
>
    <x-govuk::tab-panel
        id="tab-one"
        label="Tab label"
    >
        // Content
    </x-govuk::tab-panel>
    
    // More tab-panels
</x-govuk::tabs>
```

The main `tabs` component may contain any number of `tab-panel` components, so long as they each have a unique ID.

## Props

### Tab

| Name  | Type   | Default  | Description |
| ----- | ------ | -------- | ----------- |
| title | string | Required | The title of the tabs |

### Tab Panel

| Name  | Type   | Default  | Description |
| ----- | ------ | -------- | ----------- |
| id    | string | Required | The ID of the tab |
| label | string | Required | The label of the tab |

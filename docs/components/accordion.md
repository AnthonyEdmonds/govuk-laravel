# Accordion

Create a collapsible list of items using an `accordion` component filled with `accordion-section` components:

```html
<x-govuk::accordion id="my-accordion">
    <x-govuk::accordion-section
        label="My first accordion"
        summary="Some contents that you would find useful"
    >
        // Your content here
    </x-govuk::accordion-section>
    
    // More accordion sections...
</x-govuk::accordion>

```

## Props

### Accordion

| Name | Type   | Default  | Description |
| ---- | ------ | -------- | ----------- |
| id   | string | uniqid() | A unique identifier for the accordion and its sections |

### Accordion Section

| Name    | Type   | Default  | Description |
| ------- | ------ | -------- | ----------- |
| label   | string | Required | The label of the section |
| subid   | string | uniqid() | A unique identifier for the section |
| summary | string | null     | A brief description of the section's content |

## Subcomponents

* accordion-section

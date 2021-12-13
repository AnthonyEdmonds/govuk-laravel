# Pagination

Allow users to navigate through a paginated list of information, such as in a table.

```html
<x-govuk::pagination
    label="Related table label"
    :paginator="$results->pagination"
/>
```

The pagination component is designed for use with Laravel's `AbstractPaginator` classes, such as those retrieved from Eloquent queries.

Two types of paginator are provided:

* Simple paginator
* Length aware paginator

You should use the length aware paginator when possible.

Use the simple paginator for navigating through sets of information that have no fixed length, or are too expensive to calculate as a fixed set.

## Props

| Name | Type | Default | Description |
| ---- | ---- | ------- | ----------- |
| label | string | Required | The label of the associated list of information, such as a table |
| paginator | array or AbstractPaginator | Required | The pagination information |

### Paginator

You may either pass in an `AbstractPaginator` instance, or an array that contains the following keys for a simple paginator:

* current_page
* first_page_url
* from
* next_page_url
* prev_page_url
* to

And the following additional keys for a length aware paginator:

* last_page
* last_page_url
* links
* total

## Subcomponents

* pagination.length-aware
* pagination.simple

## Also see

* [table](table.md)

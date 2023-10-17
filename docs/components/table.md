# Table

Create a `table` element of varying forms, with conditional rendering and pagination.

```html
<x-govuk::table
    caption="Users"
    caption-size="m"
    :data="$rows"
    empty-message="No results were found"
    id="my-id"
    :paginator="$paginator"
>
    <x-govuk::table-column
        heading
        label="Name"
    >
        ~name
    </x-govuk::table-column>

    <x-govuk::table-column
        label="Age"
        numeric
    >
        ~age
    </x-govuk::table-column>
    
    <x-govuk::table-column
        hide="~hidden"
        numeric
    >
        <x-govuk::a href="{{ route('edit', ~id) }}">
            Edit
        </x-govuk::a>
    </x-govuk::table-column>
</x-govuk::table>
```

Each table contains several `table-column` components, which define the layout of the table; see the `table-column` [component documentation](table-column.md) for more details.

## Props

| Name          | Type                                                | Default          | Description                                    |
|---------------|-----------------------------------------------------|------------------|------------------------------------------------|
| caption       | string                                              | Required         | A description of the table contents            |
| captionSize   | string                                              | m                | How large the caption should be                |
| data          | array, ResourceCollection, JsonResource, Collection | Required         | An array of arrays                             |
| emptyMessage  | string                                              | No results found | The message to show when the `data` is empty   |
| id            | string                                              | null             | The ID of the table                            |
| paginator     | array or AbstractPaginator                          | null             | The table pagination information               |
| showCounter   | bool                                                | false            | Whether to show the pagination results counter |

### Data

The `data` prop accepts an array, filled with arrays that contains the table data:

```php
[
    [
        'id' => 1,
        'name' => 'Bob Bobbington',
        'age' => 32,
    ],
    [
        'id' => 2,
        'name' => 'Carl Carlington',
        'age' => 16,
    ],
]
```

#### Placeholders

Each row key may be rendered using placeholders anywhere in the `table-column` markup.

```html
<x-govuk::table caption="Users" :data="$rows">
    <x-govuk::table-column label="Name">
        ~name
    </x-govuk::table-column>
</x-govuk::table>
```

In this example, the placeholder `~name` will be replaced with the value of the `name` key in the `data` array.

You may use this with any markup, such as the Laravel route helper:

```html
<x-govuk::table caption="Users" :data="$rows">
    <x-govuk::table-column>
        <x-govuk::a href="{{ route('edit-route', ~id) }}">Edit</x-govuk::a>
    </x-govuk::table-column>
</x-govuk::table>
```

#### Using objects

You may provide a Collection or ResourceCollection, which will be automatically converted to an array.

If you provide a JsonResource, it will be converted to an array and wrapped.

The component will attempt to cast any other objects passed into the `data` prop as an array.

### Paginator

Provide the pagination information for the table, as per the `pagination` component.

If the `data` prop is a ResourceCollection that contains pagination information, it will be used instead of this prop.

## Subcomponents

* table.body
* table.cell
* table.header
* table.row

## Also see

* [pagination](pagination.md)
* [table-column](table-column.md)

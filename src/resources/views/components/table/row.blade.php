@props([
    'columns',
    'emptyMessage' => 'No results found',
    'values' => [],
])

<tr class="govuk-table__row">
    @empty($row)
        <x-govuk::table.cell
            colspan="{{ count($columns) }}"
            colour="dark-grey"
        >
            {{ $emptyMessage }}
        </x-govuk::table.cell>
    @else
        @foreach($columns as $column)
            <x-govuk::table.cell
                :column="$column"
                :values="$values"
            >
                {{ $column->html }}
            </x-govuk::table.cell>
        @endforeach
    @endempty
</tr>

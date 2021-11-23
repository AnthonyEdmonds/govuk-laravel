@props([
    'columns'
])

<thead class="govuk-table__head">
    <x-govuk::table.row>
        @foreach($columns as $column)
            <x-govuk::table.cell
                heading
                :numeric="$column['numeric']"
            >
                {{ $column['label'] }}
            </x-govuk::table.cell>
        @endforeach
    </x-govuk::table.row>
</thead>

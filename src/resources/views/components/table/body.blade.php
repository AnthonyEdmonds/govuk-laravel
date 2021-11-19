@props([
    'columns',
    'rows',
    'emptyMessage' => null,
])

<tbody class="govuk-table__body">
    @empty($rows)
        <x-govuk::table.row
            :columns="$columns"
            :emptyMessage="$emptyMessage"
        />
    @else
        @foreach($rows as $values)
            <x-govuk::table.row
                :columns="$columns"
                :emptyMessage="$emptyMessage"
                :values="$values"
            />
        @endforeach
    @endempty
</tbody>

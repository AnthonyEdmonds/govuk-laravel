@props([
    'columns',
    'emptyMessage' => null,
    'rows' => [],
])

<tbody class="govuk-table__body">
    @empty($rows)
        <x-govuk::table.row>
            <x-govuk::table.cell
                colour="dark-grey"
                colspan="{{ count($columns) }}"
            >
                {!! $emptyMessage !!}
            </x-govuk::table.cell>
        </x-govuk::table.row>
    @else
        @foreach($rows as $index => $row)
            <x-govuk::table.row>
                @foreach($columns as $column)
                    <x-govuk::table.cell
                        :heading="$column['heading']"
                        :numeric="$column['numeric']"
                    >
                        {!! AnthonyEdmonds\GovukLaravel\Helpers\GovukComponent::renderTableContent($column, $row, $index) !!}
                    </x-govuk::table.cell>
                @endforeach
            </x-govuk::table.row>
        @endforeach
    @endempty
</tbody>

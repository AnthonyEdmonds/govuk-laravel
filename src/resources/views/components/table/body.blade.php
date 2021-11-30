@props([
    'columns',
    'emptyMessage' => null,
    'rows' => [],
])

@php
    function renderContent(array $column, array $row): string
    {
        $content = $column['html'];
        
        foreach ($row as $key => $value) {
            if ("~$key" === $column['hide'] && $value == true) {
                return '';
            }
            
            $content = str_replace("~$key", $value, $content);
        }
        
        return $content;
    }
@endphp

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
        @foreach($rows as $row)
            <x-govuk::table.row>
                @foreach($columns as $column)
                    <x-govuk::table.cell
                        :heading="$column['heading']"
                        :numeric="$column['numeric']"
                    >
                        {!! renderContent($column, $row) !!}
                    </x-govuk::table.cell>
                @endforeach
            </x-govuk::table.row>
        @endforeach
    @endempty
</tbody>

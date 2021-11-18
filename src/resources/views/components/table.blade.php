@props([
    'caption',
    'captionSize' => 'm',
    'data' => [],
    'emptyMessage' => 'No results',
])

@php
    $html = $slot;
    $headings = [];

    do {
        $start = strpos($html, '~~');

        if ($start === false) {
            break;
        }

        $end = strpos($html, '~~', $start + 1);
        $length = $end - $start;

        $headings[] = explode('|', substr($html, $start + 2, $length - 2));
        $html = substr_replace($html, '', $start, $length + 2);
    } while ($start !== false);
@endphp

<table class="govuk-table">
    <caption
        class="govuk-table__caption govuk-table__caption--{{ $captionSize }}"
    >
        {{ $caption }}
    </caption>

    @empty($headings)
    @else
        <thead class="govuk-table__head">
            <tr class="govuk-table__row">
                @foreach($headings as $heading)
                    <x-table-cell-header :numeric="$heading[1]">{{ $heading[0] }}</x-table-cell-header>
                @endforeach
            </tr>
        </thead>
    @endif

    <tbody class="govuk-table__body">
        @if(count($data) < 1)
            <tr class="govuk-table__row">
                <x-table-cell-row colspan="{{ count($headings) }}" colour="dark-grey">
                    {!! $emptyMessage !!}
                </x-table-cell-row>
            </tr>
        @else
            @foreach($data as $row)
                <tr class="govuk-table__row">
                    @php
                        $content = $html;

                        foreach ($row as $key => $cell) {
                            $content = str_replace("~$key", $cell, $content);
                        }
                    @endphp

                    {!! $content !!}
                </tr>
            @endforeach
        @endempty
    </tbody>
</table>

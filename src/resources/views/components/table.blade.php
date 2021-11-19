@props([
    'caption',
    'captionSize' => 'm',
    'data' => [],
    'emptyMessage' => null,
])

@php
    $html = $slot;
    $columns = [];

    do {
        $start = strpos($html, '~~');

        if ($start === false) {
            break;
        }

        $end = strpos($html, '~~', $start + 1);
        $length = $end - $start;

        $columns[] = json_decode(substr($html, $start + 2, $length - 2));
        $html = substr_replace($html, '', $start, $length + 2);
    } while ($start !== false);
@endphp

<table class="govuk-table">
    <caption
        class="govuk-table__caption govuk-table__caption--{{ $captionSize }}"
    >
        {{ $caption }}
    </caption>
    
    <x-govuk::table.header
        :columns="$columns"
    />
    
    <x-govuk::table.body
        :columns="$columns"
        :rows="$data"
        :empty-message="$emptyMessage"
    />
</table>

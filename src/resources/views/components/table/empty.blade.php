@props([
    'colspan',
    'emptyMessage',
])

<td
    class="govuk-table__cell dark-grey"
    colspan="{{ $colspan }}"
>
    {{ $slot }}
</td>

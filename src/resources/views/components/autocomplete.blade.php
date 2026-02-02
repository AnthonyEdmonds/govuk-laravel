@props([
    'autoselect' => false,
    'id' => $name,
    'initialData' => [],
    'label',
    'minLength' => 0,
    'name',
    'placeholder' => '',
    'required' => false,
    'route' => null,
    'value' => null,
])

@php
    $containerId = "$id-container";
@endphp

<!-- TODO Add GOV.UK wrapper and styling? -->
<label>{{ $label }}</label>
<div id="{{ $containerId }}"></div>

<script>
    accessibleAutocomplete({
        autoselect: {{ $autoselect }},
        confirmOnBlur: true,
        cssNamespace: 'autocomplete', // SCSC namespace class, should not be needed
        defaultValue: '{{ old($name, $value) }}',
        displayMenu: 'inline', // "inline" or "overlay" menu type
        element: document.getElementById('{{ $containerId }}'),
        hintClasses: '', // string list of classes
        id: '{{ $id }}',
        inputClasses: '', // string list of classes
        menuAttributes: {}, // object of HTML attributes to put on menu
        menuClasses: '', // string list of classes
        minLength: {{ $minLength }},
        name: '{{ $name }}',
        placeholder: '{{ $placeholder }}',
        required: {{ $required }},
        showAllValues: false, // Whether to show values when user clicks input
        showNoOptionsFound: false, // Whether to show "no results" pane
        source: function (query, populate) {
            const results = '{{ $route }}'.length < 1
                ? {{ $initialData }}
                : ajax();

            populate(results);
        },
    });
</script>

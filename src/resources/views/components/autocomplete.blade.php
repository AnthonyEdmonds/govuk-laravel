@props([
    'id' => $name,
    'data' => [],
    'hint' => null,
    'isTitle' => false,
    'label',
    'labelSize' => null,
    'minLength' => 0,
    'name',
    'route' => null,
    'value' => null,
])

@php
    $containerId = "$id-container";
    $data = json_encode($data);
@endphp

<!-- error styling -->
<x-govuk::form-group
        :name="$name"
>
    <x-govuk::form-group.label
        :id="$id"
        :label="$label"
        :label-size="$labelSize"
        :is-title="$isTitle"
    />
    <x-govuk::form-group.hint :id="$id" :hint="$hint" />
    <x-govuk::form-group.error :id="$id" :name="$name" />

    <div
        class="govuk-!-width-one-half"
        id="{{ $containerId }}"
    ></div>
</x-govuk::form-group>

@push('post-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.accessibleAutocomplete({
                defaultValue: '{{ old($name, $value) }}',
                element: document.getElementById('{{ $containerId }}'),
                id: '{{ $id }}',
                menuClasses: 'govuk-body',
                minLength: {{ $minLength }},
                name: '{{ $name }}',
                showNoOptionsFound: true,
                source: function (query, populate) {
                    const results = '{{ $route }}'.length < 1
                        ? JSON.parse('{!! $data !!}')
                            .filter(function (item) {
                                return item.includes(query);
                            })
                        : ajax(); // TODO Own implementation or AXIOS?

                    populate(results);
                },
            });
        });
    </script>
@endpush

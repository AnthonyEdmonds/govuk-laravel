@props([
    'action',
    'hint' => null,
    'id' => $name,
    'label' => 'Search',
    'labelSize' => 'm',
    'method' => 'get',
    'name',
    'value' => null,
])

<x-govuk::form
    :action="$action"
    :method="$method"
>
    <x-govuk::form-group name="{{ $name }}">
        <x-govuk::form-group.label
            :id="$id"
            :label="$label"
            :label-size="$labelSize"
        />
        <x-govuk::form-group.hint :id="$id" :hint="$hint" />
        <x-govuk::form-group.error :id="$id" :name="$name" />

        <div class="app-search-bar">
            <input
                autocomplete="off"
                class="govuk-input"
                id="{{ $id }}"
                inputmode="search"
                name="{{ $name }}"
                spellcheck="false"
                type="search"
                value="{{ old(\AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion::bracketsToDots($name), $value) }}"
            />

            <x-govuk::button aria-label="Search">
                <svg
                    xmlns='http://www.w3.org/2000/svg'
                    viewBox='0 0 36 36'
                >
                    <path
                        d='M25.7 24.8L21.9 21c.7-1 1.1-2.2 1.1-3.5 0-3.6-2.9-6.5-6.5-6.5S10 13.9 10 17.5s2.9 6.5 6.5 6.5c1.6 0 3-.6 4.1-1.5l3.7 3.7 1.4-1.4zM12 17.5c0-2.5 2-4.5 4.5-4.5s4.5 2 4.5 4.5-2 4.5-4.5 4.5-4.5-2-4.5-4.5z'
                        fill='%23505a5f'
                    ></path>
                </svg>
            </x-govuk::button>
        </div>
    </x-govuk::form-group>

    {{ $slot }}
</x-govuk::form>

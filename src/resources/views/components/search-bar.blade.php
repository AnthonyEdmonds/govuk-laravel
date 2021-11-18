@props([
    'advanced' => false,
    'label' => 'Quick search',
    'searchTerm' => null,
    'searchType' => null,
    'searchTypeOptions' => [],
])

<x-form action="{{ route('search.results') }}" method="get">
    <x-form-group
        name="search_term"
        :label="$label"
        label-size="m"
    >
        <div class="app-search-bar">
            <input
                autocomplete="off"
                class="govuk-input"
                id="search_term"
                inputmode="text"
                name="search_term"
                spellcheck="false"
                type="text"
                value="{{ old('search_term', $searchTerm) }}"
            />

            <x-button>
                <x-icon icon="search" label="Search" />
            </x-button>
        </div>
    </x-form-group>

    @if($advanced === true)
        <x-select-input
            name="search_type"
            label="Which type of thing are you looking for?"
            :options="$searchTypeOptions"
            :value="$searchType"
        ></x-select-input>
    @elseif($searchType !== null)
        <x-hidden-input
            name="search_type"
            :value="$searchType"
        />
    @endif
</x-form>

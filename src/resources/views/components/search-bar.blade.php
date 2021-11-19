@props([
    'advanced' => false,
    'label' => 'Quick search',
    'searchTerm' => null,
    'searchType' => null,
    'searchTypeOptions' => [],
])

<x-govuk::form action="{{ route('search.results') }}" method="get">
    <x-govuk::form-group
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

            <x-govuk::button>
                <x-govuk::icon icon="search" label="Search" />
            </x-govuk::button>
        </div>
    </x-govuk::form-group>

    @if($advanced === true)
        <x-govuk::select-input
            name="search_type"
            label="Which type of thing are you looking for?"
            :options="$searchTypeOptions"
            :value="$searchType"
        ></x-govuk::select-input>
    @elseif($searchType !== null)
        <x-govuk::hidden-input
            name="search_type"
            :value="$searchType"
        />
    @endif
</x-govuk::form>

@props([
    'finder',
])

<div class="govuk-grid-row">
    <div class="govuk-grid-column-one-quarter">
        <x-govuk::search-bar
            action="{{ $finder->searchLink }}"
            label="Search"
            name="search"
            value="{{ old('search', $finder->currentSearch) }}"
        />

        <x-govuk::p small>You may search by:</x-govuk::p>
        <x-govuk::ul bulleted>
            @foreach($finder->searchable as $label)
                <li class="govuk-body-s">{{ $label }}</li>
            @endforeach
        </x-govuk::ul>
    </div>

    <div class="govuk-grid-column-one-quarter">
        <x-govuk::h2>Filters</x-govuk::h2>
        <x-govuk::ul>
            @foreach($finder->filters as $item)
                <li>
                    <x-govuk::a href="{{ $item->link }}">{{ $item->label }}</x-govuk::a>
                </li>
            @endforeach
        </x-govuk::ul>
    </div>

    <div class="govuk-grid-column-one-quarter">
        <x-govuk::h2>Statuses</x-govuk::h2>
        <x-govuk::ul>
            @foreach($finder->statuses as $item)
                <li>
                    <x-govuk::a href="{{ $item->link }}">{{ $item->label }}</x-govuk::a>
                </li>
            @endforeach
        </x-govuk::ul>
    </div>

    <div class="govuk-grid-column-one-quarter">
        <x-govuk::h2>Sorts</x-govuk::h2>
        <x-govuk::ul>
            @foreach($finder->sorts as $item)
                <li>
                    <x-govuk::a href="{{ $item->link }}">{{ $item->label }}</x-govuk::a>
                </li>
            @endforeach
        </x-govuk::ul>
    </div>
</div>

<div class="govuk-grid-row">
    <div class="govuk-grid-column-full">
        <x-govuk::p>
            <x-govuk::a href="{{ $finder->clear->link }}">{{ $finder->clear->label }}</x-govuk::a>.
        </x-govuk::p>
    </div>
</div>

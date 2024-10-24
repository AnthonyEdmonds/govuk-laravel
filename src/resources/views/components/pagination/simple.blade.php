@props([
    'currentPage',
    'firstPageUrl',
    'from' => 0,
    'label',
    'nextPageUrl' => null,
    'prevPageUrl' => null,
    'showCounter' => false,
    'to' => 0,
])

<nav
    aria-label="{{ $label }} pagination"
    class="govuk-pagination"
>
    @if($prevPageUrl !== null)
        <div class="govuk-pagination__prev">
            <a class="govuk-link govuk-pagination__link" href="{!! $prevPageUrl !!}" rel="prev">
                <svg
                    class="govuk-pagination__icon govuk-pagination__icon--prev"
                    xmlns="http://www.w3.org/2000/svg"
                    height="13"
                    width="15"
                    aria-hidden="true"
                    focusable="false"
                    viewBox="0 0 15 13"
                >
                    <path d="m6.5938-0.0078125-6.7266 6.7266 6.7441 6.4062 1.377-1.449-4.1856-3.9768h12.896v-2h-12.984l4.2931-4.293-1.414-1.414z"></path>
                </svg>
                <span class="govuk-pagination__link-title">Previous</span>
            </a>
        </div>
    @endif
    
    @if($currentPage > 1)
        <ul class="govuk-pagination__list">
            <li class="govuk-pagination__item">
                <a class="govuk-link govuk-pagination__link" href="{!! $firstPageUrl !!}" aria-label="Goto first page">
                    <x-govuk::hidden>Goto page </x-govuk::hidden>First
                </a>
            </li>
        </ul>
    @endif
        
    @if($nextPageUrl !== null)
        <div class="govuk-pagination__next">
            <a class="govuk-link govuk-pagination__link" href="{!! $nextPageUrl !!}" rel="next">
                <span class="govuk-pagination__link-title">Next</span>
                <svg
                    class="govuk-pagination__icon govuk-pagination__icon--next"
                    xmlns="http://www.w3.org/2000/svg"
                    height="13"
                    width="15"
                    aria-hidden="true"
                    focusable="false"
                    viewBox="0 0 15 13"
                >
                    <path d="m8.107-0.0078125-1.4136 1.414 4.2926 4.293h-12.986v2h12.896l-4.1855 3.9766 1.377 1.4492 6.7441-6.4062-6.7246-6.7266z"></path>
                </svg>
            </a>
        </div>
    @endif

    @if($showCounter === true)
        <div class="govuk-pagination__details">
            <x-govuk::p small>
                Showing results <b>{{ $from }}</b> to <b>{{ $to }}</b>
            </x-govuk::p>
        </div>
    @endif
</nav>

@props([
    'currentPage',
    'firstPageUrl',
    'from' => 0,
    'label',
    'lastPage',
    'lastPageUrl',
    'links',
    'nextPageUrl' => null,
    'prevPageUrl' => null,
    'showCounter' => false,
    'to' => 0,
    'total',
])

<nav
    aria-label="{{ $label }} pagination"
    class="govuk-pagination"
    role="navigation"
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

    <ul class="govuk-pagination__list">
        @if($currentPage > 2)
            <li class="govuk-pagination__item">
                <a
                    class="govuk-link govuk-pagination__link"
                    href="{!! $firstPageUrl !!}"
                    aria-label="Page 1"
                >
                    1
                </a>
            </li>
        @endif

        @if($currentPage > 4)
            <li class="govuk-pagination__item govuk-pagination__item--ellipses">&ctdot;</li>
        @endif

        @if($currentPage >= 4)
            <li class="govuk-pagination__item">
                <a
                    class="govuk-link govuk-pagination__link"
                    href="{!! $links[$currentPage - 2]['url'] !!}"
                    aria-label="Page {{ $currentPage - 2 }}"
                >
                    {{ $currentPage - 2 }}
                </a>
            </li>
        @endif

        @if($currentPage > 1)
            <li class="govuk-pagination__item">
                <a
                    class="govuk-link govuk-pagination__link"
                    href="{!! $links[$currentPage - 1]['url'] !!}"
                    aria-label="Page {{ $currentPage - 1 }}"
                >
                    {{ $currentPage - 1 }}
                </a>
            </li>
        @endif
        
        @if($lastPage !== 1)
            <li class="govuk-pagination__item govuk-pagination__item--current">
                <a
                    class="govuk-link govuk-pagination__link"
                    href="{!! $links[$currentPage]['url'] !!}"
                    aria-label="Page {{ $currentPage }}"
                    aria-current="page"
                >
                    {{ $currentPage }}
                </a>
            </li>
        @endif

        @if($currentPage < $lastPage)
            <li class="govuk-pagination__item">
                <a
                    class="govuk-link govuk-pagination__link"
                    href="{!! $links[$currentPage + 1]['url'] !!}"
                    aria-label="Page {{ $currentPage + 1 }}"
                >
                    {{ $currentPage + 1 }}
                </a>
            </li>
        @endif

        @if($currentPage < $lastPage - 1)
            <li class="govuk-pagination__item">
                <a
                    class="govuk-link govuk-pagination__link"
                    href="{!! $links[$currentPage + 2]['url'] !!}"
                    aria-label="Page {{ $currentPage + 2 }}"
                >
                    {{ $currentPage + 2 }}
                </a>
            </li>
        @endif
            
        @if($currentPage < $lastPage - 3)
            <li class="govuk-pagination__item govuk-pagination__item--ellipses">&ctdot;</li>
        @endif

        @if($currentPage < $lastPage - 2)
            <li class="govuk-pagination__item">
                <a
                    class="govuk-link govuk-pagination__link"
                    href="{!! $lastPageUrl !!}"
                    aria-label="Page {{ $lastPage }}"
                >
                    {{ $lastPage }}
                </a>
            </li>
        @endif
    </ul>

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
                Showing results <b>{{ $from }}</b> to <b>{{ $to }}</b> of <b>{{ $total }}</b>
            </x-govuk::p>
        </div>
    @endif
</nav>

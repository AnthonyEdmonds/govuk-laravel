@props([
    'currentPage',
    'firstPageUrl',
    'from' => 0,
    'label',
    'nextPageUrl' => null,
    'prevPageUrl' => null,
    'to' => 0,
])

<nav
    aria-label="{{ $label }} pagination"
    class="app-pagination"
    role="navigation"
>
    <ul>
        @if($prevPageUrl !== null)
            <li>
                <x-govuk::a href="{{ $prevPageUrl }}">
                    <svg
                        class="govuk-!-margin-left-0"
                        xmlns="http://www.w3.org/2000/svg"
                        width="17.5"
                        height="19"
                        viewBox="0 0 33 40"
                        aria-hidden="true"
                        focusable="false"
                    >
                        <path fill="currentColor" d="M 33,0 H 20 L 0,20 20,40 H 33 L 13,20 Z" />
                    </svg>Previous
                </x-govuk::a>
            </li>
        @endif
    
        @if($currentPage > 1)
            <li>
                <x-govuk::a href="{{ $firstPageUrl }}">
                    <x-govuk::hidden>Goto page </x-govuk::hidden>First
                </x-govuk::a>
            </li>
        @endif
        
        @if($nextPageUrl !== null)
            <li>
                <x-govuk::a href="{{ $nextPageUrl }}">
                    Next<svg
                        class="govuk-!-margin-right-0"
                        xmlns="http://www.w3.org/2000/svg"
                        width="17.5"
                        height="19"
                        viewBox="0 0 33 40"
                        aria-hidden="true"
                        focusable="false"
                    >
                        <path fill="currentColor" d="M0 0h13l20 20-20 20H0l20-20z" />
                    </svg>
                </x-govuk::a>
            </li>
        @endif
    </ul>

    <x-govuk::p small>
        Showing results <b>{{ $from }}</b> to <b>{{ $to }}</b>
    </x-govuk::p>
</nav>

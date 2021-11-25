@props([
    'label',
    'paginator',
])

@php
    use Illuminate\Pagination\AbstractPaginator;

    if ($paginator instanceof AbstractPaginator === true) {
        $paginator = $paginator->toArray();
    }
@endphp

@isset($paginator['last_page'])
    <x-govuk::pagination.length-aware
        :currentPage="$paginator['current_page']"
        :firstPageUrl="$paginator['first_page_url']"
        :from="$paginator['from']"
        :label="$label"
        :lastPage="$paginator['last_page']"
        :lastPageUrl="$paginator['last_page_url']"
        :links="$paginator['links']"
        :nextPageUrl="$paginator['next_page_url']"
        :prevPageUrl="$paginator['prev_page_url']"
        :to="$paginator['to']"
        :total="$paginator['total']"
    />
@else
    <x-govuk::pagination.simple
        :currentPage="$paginator['current_page']"
        :firstPageUrl="$paginator['first_page_url']"
        :from="$paginator['from']"
        :label="$label"
        :nextPageUrl="$paginator['next_page_url']"
        :prevPageUrl="$paginator['prev_page_url']"
        :to="$paginator['to']"
    />
@endisset

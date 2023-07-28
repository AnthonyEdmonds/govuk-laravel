@props([
    'label',
    'paginator',
    'showCounter' => false,
    'stacked' => false,
])

@php
    use Illuminate\Pagination\AbstractPaginator;

    if ($paginator instanceof AbstractPaginator === true) {
        $paginator = $paginator->toArray();
    }
@endphp

@if($stacked === true)
    @php
        if (isset($paginator['prev_page_label']) === true) {
            $prevPageLabel = $paginator['prev_page_label'];
        } elseif (isset($paginator['total']) === true) {
            $prevPageLabel = $paginator['current_page'] - 1 . ' of ' . $paginator['total'];
        } else {
            $prevPageLabel = 'Back to page ' . $paginator['current_page'] - 1;
        }
    
        if (isset($paginator['next_page_label']) === true) {
            $nextPageLabel = $paginator['next_page_label'];
        } elseif (isset($paginator['total']) === true) {
            $nextPageLabel = $paginator['current_page'] + 1 . ' of ' . $paginator['total'];
        } else {
            $nextPageLabel = 'On to page ' . $paginator['current_page'] + 1;
        }
    @endphp
    
    <x-govuk::pagination.stacked
        :nextPageLabel="$nextPageLabel"
        :nextPageUrl="$paginator['next_page_url']"
        :prevPageLabel="$prevPageLabel"
        :prevPageUrl="$paginator['prev_page_url']"
    />
@elseif(isset($paginator['last_page']))
    <x-govuk::pagination.length-aware
        :from="$paginator['from']"
        :label="$label"
        :links="$paginator['links']"
        :showCounter="$showCounter"
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
        :showCounter="$showCounter"
        :to="$paginator['to']"
    />
@endif

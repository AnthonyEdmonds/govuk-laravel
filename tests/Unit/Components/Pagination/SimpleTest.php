<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\Pagination;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class SimpleTest extends TestCase
{
    public function testHasLabel(): void
    {
        $this->makePagination()
            ->first('nav')
            ->hasAttribute('aria-label', 'My pagination pagination');
    }

    public function testHasPreviousPageWhenPresent(): void
    {
        $this->makePagination([
            'prevPageUrl' => 'prev-page-url',
        ])
            ->first('div.govuk-pagination__prev')
            ->hasLink('prev-page-url')
            ->contains('Previous');
    }

    public function testDoesntWhenPrevPageMissing(): void
    {
        $this->makePagination([
            'nextPageUrl' => 'next-page-url',
        ])
            ->first('div')
            ->hasClass('govuk-pagination__next');
    }

    public function testHasJumpWhenNotFirst(): void
    {
        $this->makePagination()
            ->first('ul')
            ->hasLink('first-page-url');
    }

    public function testDoesntWhenFirst(): void
    {
        $this->makePagination([
            'currentPage' => 1,
            'nextPageUrl' => 'next-page-url',
        ])
            ->first('div')
            ->hasClass('govuk-pagination__next');
    }

    public function testHasNextPageWhenPresent(): void
    {
        $this->makePagination([
            'nextPageUrl' => 'next-page-url',
        ])
            ->first('div.govuk-pagination__next')
            ->hasLink('next-page-url')
            ->first('span')
            ->contains('Next');
    }

    public function testDoesntWhenNextPageMissing(): void
    {
        $this->makePagination()
            ->first('div')
            ->hasClass('govuk-pagination__details');
    }

    public function testHasCounterWhenShowCounterTrue(): void
    {
        $this->makePagination([
            'showCounter' => true,
        ])
            ->first('div.govuk-pagination__details')
            ->contains('Showing results <b>1</b> to <b>10</b>');
    }

    public function testDoesntWhenShowCounterFalse(): void
    {
        $this->makePagination([
            'nextPageUrl' => 'next-page-url',
            'showCounter' => false,
        ])
            ->last('div')
            ->hasClass('govuk-pagination__next');
    }

    protected function makePagination(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.pagination.simple', [
            'currentPage' => $data['currentPage'] ?? 2,
            'firstPageUrl' => $data['firstPageUrl'] ?? 'first-page-url',
            'from' => $data['from'] ?? 1,
            'label' => $data['label'] ?? 'My pagination',
            'nextPageUrl' => $data['nextPageUrl'] ?? null,
            'prevPageUrl' => $data['prevPageUrl'] ?? null,
            'showCounter' => $data['showCounter'] ?? true,
            'to' => $data['to'] ?? 10,
        ]);
    }
}

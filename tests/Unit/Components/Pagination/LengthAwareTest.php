<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\Pagination;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class LengthAwareTest extends TestCase
{
    public function testHasAriaLabel(): void
    {
        $this->makePagination()
            ->first('nav')
            ->hasAttribute('aria-label', 'My pagination pagination');
    }

    public function testHasPrevButtonWhenPrevUrlSet(): void
    {
        $this->makePagination([
            'prevPageUrl' => 'prev-page-url'
        ])
            ->first('div.govuk-pagination__prev')
            ->hasLink('prev-page-url')
            ->contains('Previous');
    }

    public function testDoesntWhenPrevUrlMissing(): void
    {
        $this->makePagination([
            'nextPageUrl' => 'next-page-url',
        ])
            ->first('div')
            ->hasClass('govuk-pagination__next');
    }

    public function testHasFirstPageWhenAbovePageTwo(): void
    {
        $this->makePagination()
            ->first('ul > li')
            ->contains('1')
            ->hasLink('first-page-url');
    }

    public function testDoesntWhenPageTwoOrLower(): void
    {
        $this->makePagination([
            'currentPage' => 2,
        ])
            ->first('ul > li')
            ->hasLink('page-1-url')
            ->contains('1');
    }

    public function testHasFirstEllipsesWhenAbovePageFour(): void
    {
        $this->makePagination()
            ->at('ul > li', 1)
            ->contains('&amp;ctdot;');
    }

    public function testDoesntWhenPageFourOrLower(): void
    {
        $this->makePagination([
            'currentPage' => 4,
        ])
            ->at('ul > li', 1)
            ->hasLink('page-2-url')
            ->contains('2');
    }

    public function testHasBackTwoLinkWhenPageFour(): void
    {
        $this->makePagination([
            'currentPage' => 4,
        ])
            ->at('ul > li', 1)
            ->hasLink('page-2-url')
            ->contains('2');
    }

    public function testHasBackTwoLinkWhenLastPage(): void
    {
        $this->makePagination([
            'lastPage' => 5,
        ])
            ->at('ul > li', 2)
            ->hasLink('page-3-url')
            ->contains('3');
    }

    public function testDoesntHaveBackTwoLinkOtherwise(): void
    {
        $this->makePagination()
            ->at('ul > li', 2)
            ->hasLink('page-4-url')
            ->contains('4');
    }

    public function testHasBackLinkOneWhenCurrentPageAboveOne(): void
    {
        $this->makePagination()
            ->at('ul > li', 2)
            ->hasLink('page-4-url')
            ->contains('4');
    }

    public function testDoesntWhenCurrentPageIsOne(): void
    {
        $this->makePagination([
            'currentPage' => 1,
        ])
            ->at('ul > li', 0)
            ->hasClass('govuk-pagination__item--current');
    }

    public function testHasCurrentPageLinkWhenLastPageNotOne(): void
    {
        $this->makePagination()
            ->first('ul > li.govuk-pagination__item--current')
            ->hasLink('page-5-url')
            ->contains('5');
    }

    public function testDoesntWhenLastPageIsOne(): void
    {
        $this->makePagination([
            'lastPage' => 1,
        ])
            ->first('ul')
            ->last('li')
            ->hasLink('page-4-url');
    }

    public function testHasForwardLinkOneWhenCurrentPageLessThanLastPage(): void
    {
        $this->makePagination()
            ->at('ul > li', 4)
            ->hasLink('page-6-url')
            ->contains('6');
    }

    public function testDoesntWhenCurrentPageIsLastPage(): void
    {
        $this->makePagination([
            'lastPage' => 5,
        ])
            ->last('ul > li')
            ->hasClass('govuk-pagination__item--current');
    }

    public function testHasForwardLinkTwoWhenCurrentPageIsThreeBehindLast(): void
    {
        $this->makePagination([
            'currentPage' => 6,
        ])
            ->at('ul > li', 4)
            ->hasLink('page-7-url')
            ->contains('7');
    }

    public function testHasForwardLinkTwoWhenCurrentPageIsOneAndLastPageIsAboveThree(): void
    {
        $this->makePagination([
            'currentPage' => 1
        ])
            ->at('ul > li', 2)
            ->hasLink('page-3-url')
            ->contains('3');
    }

    public function testDoesntHaveForwardLinkTwoOtherwise(): void
    {
        $this->makePagination()
            ->at('ul > li', 5)
            ->hasClass('govuk-pagination__item--ellipses');
    }

    public function testHasLastEllipsesWhenCurrentPageIsFourLessThanLastPage(): void
    {
        $this->makePagination()
            ->at('ul > li', 5)
            ->contains('&amp;ctdot;');
    }

    public function testDoesntWhenCurrentPageIsThreeLessOrHigherThanLastPage(): void
    {
        $this->makePagination([
            'currentPage' => 6
        ])
            ->at('ul > li', 5)
            ->hasLink('page-8-url');
    }

    public function testHasLastPageWhenCurrentPageIsTwoLessThanLastPage(): void
    {
        $this->makePagination()
            ->at('ul > li', 6)
            ->hasLink('last-page-url')
            ->contains('9');
    }

    public function testDoesntWhenCurrentPageIsOneOrLessThanLastPage(): void
    {
        $this->makePagination([
            'currentPage' => 8
        ])
            ->at('ul > li', 4)
            ->hasLink('page-9-url');
    }

    public function testHasNextButtonWhenNextUrlSet(): void
    {
        $this->makePagination([
            'nextPageUrl' => 'next-page-url',
        ])
            ->first('div.govuk-pagination__next')
            ->hasLink('next-page-url')
            ->contains('Next');
    }

    public function testDoesntWhenNextUrlMissing(): void
    {
        $this->makePagination([
            'prevPageUrl' => 'prev-page-url',
            'showCounter' => false,
        ])
            ->last('div')
            ->hasClass('govuk-pagination__prev');
    }

    public function testHasCounterWhenTrue(): void
    {
        $this->makePagination()
            ->last('div')
            ->hasClass('govuk-pagination__details')
            ->contains('Showing results <b>41</b> to <b>50</b> of <b>99</b>');
    }

    public function testDoesntHaveCounterWhenFalse(): void
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
        return $this->assertView('govuk::components.pagination.length-aware', [
            'currentPage' => $data['currentPage'] ?? 5,
            'firstPageUrl' => $data['firstPageUrl'] ?? 'first-page-url',
            'from' => $data['from'] ?? 41,
            'label' => $data['label'] ?? 'My pagination',
            'lastPage' => $data['lastPage'] ?? 9,
            'lastPageUrl' => $data['lastPageUrl'] ?? 'last-page-url',
            'links' => $data['links'] ?? [
                1 => ['url' => 'page-1-url'],
                2 => ['url' => 'page-2-url'],
                3 => ['url' => 'page-3-url'],
                4 => ['url' => 'page-4-url'],
                5 => ['url' => 'page-5-url'],
                6 => ['url' => 'page-6-url'],
                7 => ['url' => 'page-7-url'],
                8 => ['url' => 'page-8-url'],
                9 => ['url' => 'page-9-url'],
            ],
            'nextPageUrl' => $data['nextPageUrl'] ?? null,
            'prevPageUrl' => $data['prevPageUrl'] ?? null,
            'showCounter' => $data['showCounter'] ?? true,
            'to' => $data['to'] ?? 50,
            'total' => $data['total'] ?? 99,
        ]);
    }
}

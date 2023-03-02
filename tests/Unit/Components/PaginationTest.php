<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Pagination\Paginator;
use NunoMaduro\LaravelMojito\ViewAssertion;

class PaginationTest extends TestCase
{
    public function testAcceptsArrayPagination(): void
    {
        $this->makePagination([
            'paginator' => $this->stackedPagination(),
            'stacked' => true,
        ])
            ->first('nav')
            ->contains('On to page 2');
    }

    public function testAcceptsAbstractPagination(): void
    {
        $this->makePagination([
            'paginator' => new Paginator([], 5, 2, [
                'path' => 'my-path',
            ]),
            'stacked' => true,
        ])
            ->first('nav')
            ->contains('Back to page 1');
    }

    public function testCreatesStackedWithPageLabels(): void
    {
        $pagination = $this->makePagination([
            'paginator' => $this->stackedPagination(
                'Next label',
                'Prev label'
            ),
            'stacked' => true,
        ]);

        $pagination->first('nav > div')
            ->contains('Prev label');

        $pagination->last('nav > div')
            ->contains('Next label');
    }

    public function testCreatesStackedWithCurrentPageAndTotal(): void
    {
        $pagination = $this->makePagination([
            'paginator' => $this->stackedPagination(
                null,
                null,
                10
            ),
            'stacked' => true,
        ]);

        $pagination->first('nav > div')
            ->contains('0 of 10');

        $pagination->last('nav > div')
            ->contains('2 of 10');
    }

    public function testCreatesStackedWithCurrentPage(): void
    {
        $pagination = $this->makePagination([
            'paginator' => $this->stackedPagination(),
            'stacked' => true,
        ]);

        $pagination->first('nav > div')
            ->contains('Back to page 0');

        $pagination->last('nav > div')
            ->contains('On to page 2');
    }

    public function testCreatesLengthAwarePagination(): void
    {
        $this->makePagination([
            'paginator' => [
                'current_page' => 5,
                'first_page_url' => 'first-link',
                'from' => 1,
                'last_page' => 10,
                'last_page_url' => 'last-link',
                'links' => [
                    1 => ['url' => 'page-1-link'],
                    2 => ['url' => 'page-2-link'],
                    3 => ['url' => 'page-3-link'],
                    4 => ['url' => 'page-4-link'],
                    5 => ['url' => 'page-5-link'],
                    6 => ['url' => 'page-6-link'],
                    7 => ['url' => 'page-7-link'],
                    8 => ['url' => 'page-8-link'],
                    9 => ['url' => 'page-9-link'],
                    10 => ['url' => 'page-10-link'],
                ],
                'next_page_url' => 'next-link',
                'prev_page_url' => 'prev-link',
                'to' => 10,
                'total' => 50,
            ],
        ])
            ->first('nav > ul')
            ->at('li', 1)
            ->contains('&amp;ctdot;');
    }

    public function testCreatesSimplePagination(): void
    {
        $this->makePagination([
            'paginator' => [
                'current_page' => 2,
                'first_page_url' => 'first-link',
                'from' => 1,
                'next_page_url' => 'next-link',
                'prev_page_url' => 'prev-link',
                'to' => 10,
            ],
        ])
            ->first('nav > ul > li')
            ->contains('Goto page');
    }

    protected function makePagination(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.pagination', [
            'label' => $data['label'] ?? 'My label',
            'paginator' => $data['paginator'] ?? [],
            'showCounter' => $data['showCounter'] ?? false,
            'stacked' => $data['stacked'] ?? false,
        ]);
    }

    protected function stackedPagination(
        string|null $nextPageLabel = null,
        string|null $prevPageLabel = null,
        int|null $total = null,
    ): array {
        return [
            'current_page' => 1,
            'next_page_label' => $nextPageLabel,
            'next_page_url' => 'next-link',
            'prev_page_label' => $prevPageLabel,
            'prev_page_url' => 'prev-link',
            'total' => $total,
        ];
    }
}

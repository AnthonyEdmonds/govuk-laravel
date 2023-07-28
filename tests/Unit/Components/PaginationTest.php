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
                'from' => 1,
                'last_page' => 535,
                'links' => [
                    0 => $this->makeLink('Previous', 'page-253-url'),
                    1 => $this->makeLink('1', 'page-1-url'),
                    2 => $this->makeLink('2', 'page-2-url'),
                    3 => $this->makeLink('...', null),
                    4 => $this->makeLink('251', 'page-251-url'),
                    5 => $this->makeLink('252', 'page-252-url'),
                    6 => $this->makeLink('253', 'page-253-url'),
                    7 => $this->makeLink('254', 'page-254-url', true),
                    8 => $this->makeLink('256', 'page-255-url'),
                    9 => $this->makeLink('257', 'page-256-url'),
                    10 => $this->makeLink('258', 'page-257-url'),
                    11 => $this->makeLink('...', null),
                    12 => $this->makeLink('534', 'page-534-url'),
                    13 => $this->makeLink('535', 'page-535-url'),
                    14 => $this->makeLink('Next', 'page-255-url'),
                ],
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
        string $nextPageLabel = null,
        string $prevPageLabel = null,
        int $total = null,
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

    protected function makeLink(string $label, ?string $url, bool $active = false): array
    {
        return [
            'url' => $url,
            'label' => $label,
            'active' => $active,
        ];
    }
}

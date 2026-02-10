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

    public function testHasPrevButtonWhenNotNull(): void
    {
        $this->makePagination()
            ->first('div.govuk-pagination__prev')
            ->hasLink('page-253-url')
            ->contains('Previous');
    }

    public function testDoesntHavePrevButtonWhenNull(): void
    {
        $this->makePagination([
            'prev-link' => null,
        ])
            ->first('div')
            ->hasClass('govuk-pagination__next');
    }

    public function testHasFirstPage(): void
    {
        $this->makePagination()
            ->at('ul > li', 0)
            ->contains('1')
            ->hasLink('page-1-url');
    }

    public function testDoesntHavePageTwo(): void
    {
        $this->makePagination()
            ->at('ul > li', 1)
            ->hasClass('govuk-pagination__item--ellipsis');
    }

    public function testHasCurrentSubTwo(): void
    {
        $this->makePagination()
            ->at('ul > li', 2)
            ->hasLink('page-252-url')
            ->contains('252');
    }

    public function testHasCurrentSubOne(): void
    {
        $this->makePagination()
            ->at('ul > li', 3)
            ->hasLink('page-253-url')
            ->contains('253');
    }

    public function testHasCurrent(): void
    {
        $this->makePagination()
            ->at('ul > li', 4)
            ->hasClass('govuk-pagination__item--current')
            ->hasLink('page-254-url')
            ->contains('254');
    }

    public function testHasCurrentPlusOne(): void
    {
        $this->makePagination()
            ->at('ul > li', 5)
            ->hasLink('page-255-url')
            ->contains('255');
    }

    public function testHasCurrentPlusTwo(): void
    {
        $this->makePagination()
            ->at('ul > li', 6)
            ->hasLink('page-256-url')
            ->contains('256');
    }

    public function testDoesntHavePagePlusThree(): void
    {
        $this->makePagination()
            ->at('ul > li', 7)
            ->hasClass('govuk-pagination__item--ellipsis');
    }

    public function testHasLastPage(): void
    {
        $this->makePagination()
            ->at('ul > li', 8)
            ->contains('535')
            ->hasLink('page-535-url');
    }

    public function testHasNextButtonWhenNotNull(): void
    {
        $this->makePagination()
            ->first('div.govuk-pagination__next')
            ->hasLink('page-255-url')
            ->contains('Next');
    }

    public function testDoesntHaveNextButtonWhenNull(): void
    {
        $this->makePagination([
            'next-link' => null,
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
            ->contains('Showing results <b>2540</b> to <b>2549</b> of <b>5350</b>');
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
            'from' => $data['from'] ?? 2540,
            'label' => $data['label'] ?? 'My pagination',
            'links' => $data['links'] ?? [
                0 => $this->makeLink(
                    'Previous',
                    array_key_exists('prev-link', $data) === true
                        ? $data['prev-link']
                        : 'page-253-url',
                ),
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
                14 => $this->makeLink(
                    'Next',
                    array_key_exists('next-link', $data) === true
                        ? $data['next-link']
                        : 'page-255-url',
                ),
            ],
            'showCounter' => $data['showCounter'] ?? true,
            'to' => $data['to'] ?? 2549,
            'total' => $data['total'] ?? 5350,
        ]);
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

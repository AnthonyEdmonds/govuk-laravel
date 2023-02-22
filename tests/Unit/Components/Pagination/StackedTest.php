<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\Pagination;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use InvalidArgumentException;
use NunoMaduro\LaravelMojito\ViewAssertion;

class StackedTest extends TestCase
{
    public function testHasPreviousLink(): void
    {
        $this->makePagination()
            ->first('a.govuk-link')
            ->hasLink('Prev-URL')
            ->contains('Prev label');
    }

    public function testNoPreviousLinkWhenNull(): void
    {
        $this->makePagination('Next-URL', null)
            ->first('a.govuk-link')
            ->hasLink('Next-URL');
    }

    public function testHasNextLink(): void
    {
        $this->makePagination()
            ->last('a.govuk-link')
            ->hasLink('Next-URL')
            ->contains('Next label');
    }

    public function testNoNextLinkWhenNull(): void
    {
        $this->makePagination(null)
            ->last('a.govuk-link')
            ->hasLink('Prev-URL');
    }

    public function testNoPaginationWhenNull(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The current node list is empty.');
        
        $this->makePagination(null, null);
    }

    protected function makePagination(
        string|null $nextUrl = 'Next-URL',
        string|null $prevUrl = 'Prev-URL',
    ): ViewAssertion {
        return $this->assertView('govuk::components.pagination.stacked', [
            'nextPageLabel' => 'Next label',
            'nextPageUrl' => $nextUrl,
            'prevPageLabel' => 'Prev label',
            'prevPageUrl' => $prevUrl,
        ]);
    }
}

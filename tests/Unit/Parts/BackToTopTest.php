<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Parts;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class BackToTopTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('govuk.parts.back_to_top', 'Back to top');
    }

    public function test(): void
    {
        $this->makeComponent()
            ->first('p > a')
            ->contains('Back to top');
    }

    protected function makeComponent(): ViewAssertion
    {
        return $this->assertView('govuk::parts.back-to-top');
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\NotificationBanner;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class HeadingTest extends TestCase
{
    public function testHasContent(): void
    {
        $this->makeComponent()
            ->first('p')
            ->contains('My content');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.notification-banner.heading');
    }
}

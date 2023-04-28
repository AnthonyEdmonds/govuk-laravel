<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class NotificationBannerTest extends TestCase
{
    public function testHasTitle(): void
    {
        $this->makeComponent()
            ->first('div > div > h2')
            ->contains('My title');
    }

    public function testHasContent(): void
    {
        $this->makeComponent()
            ->last('div > div')
            ->contains('My content');
    }

    public function testHasColour(): void
    {
        $this->makeComponent()
            ->first('div')
            ->hasClass('app-\!-background-blue')
            ->hasClass('app-\!-border-blue');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');
        $this->setViewSlot('title', 'My title');

        return $this->assertView('govuk::components.notification-banner', [
            'colour' => $data['colour'] ?? 'blue',
            'title' => $data['title'] ?? 'My title',
        ]);
    }
}

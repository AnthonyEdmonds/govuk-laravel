<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class NotificationBannerTest extends TestCase
{
    public function test(): void
    {
        $banner = $this->makeComponent();

        $banner
            ->first('div')
            ->hasClass('app-\!-notification-banner-info')
            ->first('h2')
            ->contains('My title');

        $banner->last('div')
            ->contains('My content');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');
        $this->setViewSlot('title', 'My title');

        return $this->assertView('govuk::components.notification-banner', [
            'colour' => $data['colour'] ?? 'info',
            'title' => $data['title'] ?? 'My title',
        ]);
    }
}

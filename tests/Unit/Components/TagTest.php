<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class TagTest extends TestCase
{
    public function testHasColour(): void
    {
        $this->makeComponent()
            ->first('strong')
            ->hasClass('govuk-tag--blue');
    }

    public function testHasId(): void
    {
        $this->makeComponent([
            'id' => 'my-id',
        ])
            ->first('strong')
            ->hasAttribute('id', 'my-id');
    }

    public function testHasLabel(): void
    {
        $this->makeComponent()
            ->first('strong')
            ->contains('My label');
    }

    public function testHasPhase(): void
    {
        $this->makeComponent([
            'phase' => true,
        ])
            ->first('strong')
            ->hasClass('govuk-phase-banner__content__tag');
    }

    public function testHasTaskList(): void
    {
        $this->makeComponent([
            'task_list' => true,
        ])
            ->first('strong')
            ->hasClass('app-task-list__tag');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.tag', [
            'colour' => $data['colour'] ?? 'blue',
            'id' => $data['id'] ?? null,
            'label' => $data['label'] ?? 'My label',
            'phase' => $data['phase'] ?? false,
            'taskList' => $data['task_list'] ?? false,
        ]);
    }
}

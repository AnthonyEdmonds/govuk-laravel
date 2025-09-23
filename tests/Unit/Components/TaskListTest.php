<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Helpers\TaskList;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class TaskListTest extends TestCase
{
    public function testHasTitle(): void
    {
        $this->makeComponent()
            ->first('h2')
            ->contains('My title');
    }

    public function testHasBasicTask(): void
    {
        $task = $this->makeComponent()
            ->first('ul')
            ->at('li', 0)
            ->hasClass('govuk-task-list__item--with-link');

        $task->first('div > a')
            ->hasAttribute('aria-describedby', 'basic-task-status')
            ->hasAttribute('href', 'my-url')
            ->contains('Basic task');

        $task->last('div')
            ->hasAttribute('id', 'basic-task-status')
            ->contains('Custom status');
    }

    public function testHasBasicDisabledTask(): void
    {
        $task = $this->makeComponent()
            ->first('ul')
            ->at('li', 1);

        $task->first('div > span')
            ->hasAttribute('aria-describedby', 'disabled-task-status')
            ->contains('Disabled task');

        $task->last('div')
            ->hasClass('govuk-task-list__status--cannot-start-yet')
            ->contains(TaskList::CANNOT_START);
    }

    public function testHasTagTask(): void
    {
        $task = $this->makeComponent()
            ->first('ul')
            ->at('li', 2);

        $task->first('div > a')
            ->hasAttribute('aria-describedby', 'my-id-status')
            ->hasAttribute('href', 'task-two-url')
            ->contains('Tag task');

        $task->first('div > div')
            ->hasAttribute('id', 'my-id-hint')
            ->first('p')
            ->contains('My hint');

        $task->last('div')
            ->hasAttribute('id', 'my-id-status')
            ->first('strong')
            ->hasClass('govuk-tag--' . TaskList::STATUSES[TaskList::NOT_STARTED])
            ->contains(TaskList::NOT_STARTED);
    }

    public function testHasCustomStatusTask(): void
    {
        $task = $this->makeComponent()
            ->first('ul')
            ->at('li', 3);

        $task->first('div > a')
            ->hasAttribute('href', 'task-three-url')
            ->contains('Custom status');

        $task->last('div > strong')
            ->hasClass('govuk-tag--puce')
            ->contains('Plums');
    }

    public function testHasLabelFromDetails(): void
    {
        $task = $this->makeComponent()
            ->first('ul')
            ->at('li', 4);

        $task->first('div > a')
            ->hasAttribute('href', 'my-url')
            ->contains('Inline label');

        $hints = $task->first('div > div');
        $hints->first('p')->contains('Hint one');
        $hints->last('p')->contains('Hint two');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.task-list', [
            'tasks' => $data['list'] ?? [
                'Basic task' => [
                    'status' => 'Custom status',
                    'url' => 'my-url',
                ],
                'Disabled task' => [
                    'status' => TaskList::CANNOT_START,
                ],
                'Tag task' => [
                    'hint' => 'My hint',
                    'id' => 'my-id',
                    'status' => TaskList::NOT_STARTED,
                    'url' => 'task-two-url',
                ],
                'Custom status' => [
                    'colour' => 'puce',
                    'status' => 'Plums',
                    'url' => 'task-three-url',
                ],
                'Details label' => [
                    'hint' => [
                        'Hint one',
                        'Hint two',
                    ],
                    'label' => 'Inline label',
                    'status' => TaskList::NOT_STARTED,
                    'url' => 'my-url',
                ],
            ],
            'title' => 'My title',
        ]);
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Helpers\TaskList;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class TaskListTest extends TestCase
{
    public function testHasList(): void
    {
        $list = $this->makeComponent()->first('ol');

        $sectionOne = $list->at('ol > li', 0);
        $sectionTwo = $list->at('ol > li', 1);

        $sectionOne
            ->first('h2')
            ->contains('Section one')
            ->first('span')
            ->contains('1.');

        $sectionTwo
            ->first('h2')
            ->contains('Section two')
            ->first('span')
            ->contains('2.');

        $this->testTask($sectionOne->at('ul > li', 0), 'one', TaskList::CANNOT_START_YET);
        $this->testTask($sectionOne->at('ul > li', 1), 'two', TaskList::NOT_STARTED);
        $this->testTask($sectionOne->at('ul > li', 2), 'three', TaskList::IN_PROGRESS);
        $this->testTask($sectionOne->at('ul > li', 3), 'four', TaskList::COMPLETED);
        $this->testTask($sectionTwo->at('ul > li', 0), 'five', TaskList::CANNOT_START_YET);
    }

    protected function testTask(ViewAssertion $task, string $number, string $status): void
    {
        $task->first('a')
            ->hasAttribute('href', "task-$number-url")
            ->hasAttribute('aria-describedby', "task_$number");

        $task->first('strong')
            ->hasClass('govuk-tag--'.TaskList::STATUSES[$status])
            ->hasAttribute('id', "task_$number");
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.task-list', [
            'list' => $data['list'] ?? [
                'Section one' => [
                    'Task one' => [
                        'status' => TaskList::CANNOT_START_YET,
                        'url' => 'task-one-url',
                    ],
                    'Task two' => [
                        'status' => TaskList::NOT_STARTED,
                        'url' => 'task-two-url',
                    ],
                    'Task three' => [
                        'status' => TaskList::IN_PROGRESS,
                        'url' => 'task-three-url',
                    ],
                    'Task four' => [
                        'status' => TaskList::COMPLETED,
                        'url' => 'task-four-url',
                    ],
                ],
                'Section two' => [
                    'Task five' => [
                        'status' => TaskList::CANNOT_START_YET,
                        'url' => 'task-five-url',
                    ],
                ],
            ],
        ]);
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Components\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\DataProvider;

class QuestionTest extends TestCase
{
    protected Question $question;

    #[DataProvider('expectations')]
    public function test(
        ?string $blade,
        array|Arrayable $settings,
        string $expectedType,
        string $expectedBlade,
    ): void {
        $this->question = new Question($blade, $settings);

        $this->assertEquals(
            $expectedType,
            $this->question->settings['type'],
        );

        $this->assertEquals(
            $expectedBlade,
            $this->question->blade,
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'blade' => 'potato',
                'settings' => [],
                'expectedType' => 'text-input',
                'expectedBlade' => 'potato',
            ],
            [
                'blade' => 'potato',
                'settings' => new Collection([]),
                'expectedType' => 'text-input',
                'expectedBlade' => 'potato',
            ],
            [
                'blade' => null,
                'settings' => [
                    'blade' => 'potato',
                    'type' => 'goose',
                ],
                'expectedType' => 'goose',
                'expectedBlade' => 'potato',
            ],
            [
                'blade' => null,
                'settings' => [
                    'type' => 'checkbox',
                ],
                'expectedType' => 'checkbox',
                'expectedBlade' => 'checkboxes',
            ],
            [
                'blade' => null,
                'settings' => [
                    'type' => 'date',
                ],
                'expectedType' => 'date',
                'expectedBlade' => 'date-input',
            ],
            [
                'blade' => null,
                'settings' => [
                    'type' => 'file',
                ],
                'expectedType' => 'file',
                'expectedBlade' => 'file-upload',
            ],
            [
                'blade' => null,
                'settings' => [
                    'type' => 'hidden',
                ],
                'expectedType' => 'hidden',
                'expectedBlade' => 'hidden-input',
            ],
            [
                'blade' => null,
                'settings' => [
                    'type' => 'password',
                ],
                'expectedType' => 'password',
                'expectedBlade' => 'password',
            ],
            [
                'blade' => null,
                'settings' => [
                    'type' => 'radio',
                ],
                'expectedType' => 'radio',
                'expectedBlade' => 'radios',
            ],
            [
                'blade' => null,
                'settings' => [
                    'type' => 'select',
                ],
                'expectedType' => 'select',
                'expectedBlade' => 'select',
            ],
            [
                'blade' => null,
                'settings' => [
                    'type' => 'textarea',
                ],
                'expectedType' => 'textarea',
                'expectedBlade' => 'textarea',
            ],
            [
                'blade' => null,
                'settings' => [
                    'type' => 'time',
                ],
                'expectedType' => 'time',
                'expectedBlade' => 'time-input',
            ],
            [
                'blade' => null,
                'settings' => [],
                'expectedType' => 'text-input',
                'expectedBlade' => 'text-input',
            ],
        ];
    }
}

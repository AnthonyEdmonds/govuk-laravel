<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\SecondQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\ThirdQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ToSummaryTest extends TestCase
{
    protected array $data;

    protected array $summary;

    protected FormModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        $this->data = [
            FirstQuestion::key() => [
                'value' => 1,
                'key' => FirstQuestion::key(),
            ],
            SecondQuestion::key() . '-a' => [
                'value' => 'Hello',
                'key' => SecondQuestion::key(),
            ],
            SecondQuestion::key() . '-b' => [
                'value' => [],
                'key' => SecondQuestion::key(),
            ],
            ThirdQuestion::key() => [
                'value' => null,
                'key' => ThirdQuestion::key(),
            ],
        ];

        $this->model = new FormModel();
        $this->model->setRawAttributes(
            array_combine(
                array_keys($this->data),
                array_column($this->data, 'value'),
            ),
        );
        $this->summary = $this->model->toSummary(true);
    }

    public function testKeysByLabel(): void
    {
        foreach ($this->data as $label => $data) {
            $this->assertArrayHasKey(
                $this->formatLabel($label),
                $this->summary,
            );
        }
    }

    public function testHasValue(): void
    {
        $this->assertEquals(
            [
                1,
                'Hello',
                $this->model->blankFieldTerm,
                $this->model->blankFieldTerm,
            ],
            array_column($this->summary, 'value'),
        );
    }

    public function testHasActionWhenTrue(): void
    {
        foreach ($this->data as $label => $data) {
            $label = $this->formatLabel($label);

            $this->assertEquals(
                $label,
                $this->summary[$label]['action']['hidden'],
            );

            $this->assertEquals(
                route('forms.question', [
                    TestForm::key(),
                    TestForm::REVIEW,
                    $data['key'],
                ]),
                $this->summary[$label]['action']['url'],
            );
        }
    }

    public function testActionNullWhenFalse(): void
    {
        $this->summary = $this->model->toSummary(false);

        foreach ($this->summary as $entry) {
            $this->assertNull($entry['action']);
        }
    }

    protected function formatLabel(string $key): string
    {
        return ucfirst(str_replace('_', ' ', $key));
    }
}

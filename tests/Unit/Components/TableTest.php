<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestView;

class TableTest extends TestCase
{
    protected Collection $data;
    protected TestView $view;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->data = $this->tableData();
        $this->view = $this->makeTable($this->data);
    }

    public function test(): void
    {
        $this->view->assertSee('Swan');
    }
    
    protected function tableData(): Collection
    {
        return new Collection([
            $this->tableRow(),
            $this->tableRow(false),
            $this->tableRow(true),
        ]);
    }
    
    protected function tableRow(bool $hide = null): Collection
    {
        return new Collection([
            'name' => $this->faker->word,
            'colour' => $this->faker->colorName,
            'hidden' => $hide,
        ]);
    }
    
    protected function makeTable(
        Collection $data,
        string $caption = 'Swans and Geese',
        string $captionSize = 'm',
        string $emptyMessage = 'No results found'
    ): TestView
    {
        return $this->blade('
            <x-govuk::table
                :caption="$caption"
                :caption-size="$captionSize"
                :data="$data"
                :empty-message="$emptyMessage"
            >
                <x-govuk::table-column
                    heading
                    hide="~hidden"
                    label="Name"
                    numeric
                >
                    <x-govuk::p>~name</x-govuk::p>
                </x-govuk::table-column>
                
                <x-govuk::table-column
                    hide="~hidden"
                    label="Colour"
                >
                    <x-govuk::p>~colour</x-govuk::p>
                </x-govuk::table-column>
            </x-govuk::table>
        ', [
            'caption' => $caption,
            'captionSize' => $captionSize,
            'data' => $data,
            'emptyMessage' => $emptyMessage
        ]);
    }
}

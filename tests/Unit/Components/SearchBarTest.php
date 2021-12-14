<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class SearchBarTest extends TestCase
{
    public function testHasAction(): void
    {
        $this->makeSearchInput()
            ->first('form')
            ->hasAttribute('action', 'my-action');
    }

    public function testHasHint(): void
    {
        $this->makeSearchInput()
            ->first('.govuk-hint')
            ->contains('my-hint');
    }

    public function testHasId(): void
    {
        $this->makeSearchInput()
            ->first('.app-search-bar input')
            ->hasAttribute('id', 'my-id');
    }

    public function testHasLabel(): void
    {
        $this->makeSearchInput()
            ->first('label')
            ->contains('my-label');
    }

    public function testHasLabelSize(): void
    {
        $this->makeSearchInput()
            ->first('label')
            ->hasClass('govuk-label--xl');
    }

    public function testHasMethod(): void
    {
        $this->makeSearchInput()
            ->first('form')
            ->hasAttribute('method', 'post');
    }

    public function testHasName(): void
    {
        $this->makeSearchInput()
            ->first('.app-search-bar input')
            ->hasAttribute('name', 'my-name');
    }

    public function testHasValue(): void
    {
        $this->makeSearchInput()
            ->first('.app-search-bar input')
            ->hasAttribute('value', 'my-value');
    }

    public function testHasOldValue(): void
    {
        $this->setRequestOld([
            'my-name' => 'old-value',
        ]);

        $this->makeSearchInput()
            ->first('.app-search-bar input')
            ->hasAttribute('value', 'old-value');
    }

    public function testSlotRenders(): void
    {
        $this->makeSearchInput()
            ->first('p')
            ->contains('My slot');
    }

    protected function makeSearchInput(): ViewAssertion
    {
        $this->setViewAttributes();
        $this->setViewErrors();
        $this->setViewSlot('<p>My slot</p>');

        return $this->assertView('govuk::components.search-bar', [
            'action' => 'my-action',
            'hint' => 'my-hint',
            'id' => 'my-id',
            'label' => 'my-label',
            'labelSize' => 'xl',
            'method' => 'post',
            'name' => 'my-name',
            'value' => 'my-value',
        ]);
    }
}

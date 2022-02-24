<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class RadiosTest extends TestCase
{
    public function testHasHint(): void
    {
        $this
            ->makeSimpleRadios()
            ->last('div .govuk-hint')
            ->contains('My hint');
    }

    public function testHasId(): void
    {
        $this
            ->makeSimpleRadios()
            ->last('input')
            ->hasAttribute('id', 'my-id_3');
    }

    public function testStylesInline(): void
    {
        $this
            ->makeSimpleRadios()
            ->first('div .govuk-radios')
            ->hasClass('govuk-radios--inline');
    }

    public function testStylesSmall(): void
    {
        $this
            ->makeSimpleRadios()
            ->first('div .govuk-radios')
            ->hasClass('govuk-radios--small');
    }

    public function testStylesLabelAsLabel(): void
    {
        $this
            ->makeSimpleRadios()
            ->first('legend')
            ->contains('My label');
    }

    public function testHasLabelSize(): void
    {
        $this
            ->makeSimpleRadios()
            ->first('legend')
            ->hasClass('govuk-fieldset__legend--xl');
    }

    public function testHasName(): void
    {
        $this
            ->makeSimpleRadios()
            ->first('input')
            ->hasAttribute('name', 'my-name');

        $this
            ->makeSimpleRadios()
            ->last('input')
            ->hasAttribute('name', 'my-name');
    }

    public function testSelectsCurrentValue(): void
    {
        $this
            ->makeSimpleRadios()
            ->first('#my-id_2')
            ->hasAttribute('checked', 'checked');
    }

    public function testHasSimpleOptions(): void
    {
        $first = $this
            ->makeSimpleRadios()
            ->first('div .govuk-radios__item');

        $first
            ->first('input')
            ->hasAttribute('value', 'value-one');

        $first
            ->first('label')
            ->contains('Option one');

        $last = $this
            ->makeSimpleRadios()
            ->last('div .govuk-radios__item');

        $last
            ->first('input')
            ->hasAttribute('value', 'value-three');

        $last
            ->first('label')
            ->contains('Option three');
    }

    public function testHasConditionalOptions(): void
    {
        $radios = $this->makeConditionalRadios();

        $first = $radios->first('div .govuk-radios__item');

        $first
            ->first('input')
            ->hasAttribute('value', 'value-one');

        $first
            ->first('label')
            ->contains('Option one');

        $first
            ->first('div .govuk-hint')
            ->contains('Hint one');

        $firstConditional = $radios->first('.govuk-radios__conditional');

        $firstConditional
            ->first('input')
            ->hasAttribute('name', 'conditional-one');

        $firstConditional
            ->first('label')
            ->contains('Conditional one');
    }

    public function testHasDivider(): void
    {
        $this->makeConditionalRadios()
            ->last('div .govuk-radios__divider')
            ->contains('or');
    }

    public function testStylesLabelAsTitle(): void
    {
        $this->makeConditionalRadios()
            ->first('legend h1')
            ->contains('My label');
    }

    protected function makeSimpleRadios(): ViewAssertion
    {
        $this->setViewAttributes();
        $this->setViewErrors();

        return $this->assertView('govuk::components.radios', [
            'hint' => 'My hint',
            'id' => 'my-id',
            'isInline' => true,
            'isSmall' => true,
            'label' => 'My label',
            'labelSize' => 'xl',
            'name' => 'my-name',
            'options' => [
                'value-one' => 'Option one',
                'value-two' => 'Option two',
                'value-three' => 'Option three',
            ],
            'value' => 'value-two',
        ]);
    }

    protected function makeConditionalRadios(): ViewAssertion
    {
        $this->setViewAttributes();
        $this->setViewErrors();

        return $this->assertView('govuk::components.radios', [
            'isTitle' => true,
            'label' => 'My label',
            'name' => 'my-name',
            'options' => [
                'value-one' => [
                    'hint' => 'Hint one',
                    'label' => 'Option one',
                    'inputs' => [
                        [
                            'label' => 'Conditional one',
                            'name' => 'conditional-one',
                        ],
                    ],
                ],
                'value-two' => [
                    'divider' => true,
                    'label' => 'or',
                ],
            ],
        ]);
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class CheckboxesTest extends TestCase
{
    public function testHasHint(): void
    {
        $this
            ->makeSimpleCheckboxes()
            ->first('div .govuk-hint')
            ->contains('My hint');
    }

    public function testHasId(): void
    {
        $this
            ->makeSimpleCheckboxes()
            ->first('input')
            ->hasAttribute('id', 'my-id_1');

        $this
            ->makeSimpleCheckboxes()
            ->last('input')
            ->hasAttribute('id', 'my-id_3');
    }

    public function testStylesSmall(): void
    {
        $this
            ->makeSimpleCheckboxes()
            ->first('div .govuk-checkboxes')
            ->hasClass('govuk-checkboxes--small');
    }

    public function testStylesLabelAsLabel(): void
    {
        $this
            ->makeSimpleCheckboxes()
            ->first('legend')
            ->contains('My label');
    }

    public function testHasLabelSize(): void
    {
        $this
            ->makeSimpleCheckboxes()
            ->first('legend')
            ->hasClass('govuk-fieldset__legend--xl');
    }

    public function testHasName(): void
    {
        $this
            ->makeSimpleCheckboxes()
            ->first('input')
            ->hasAttribute('name', 'my-name[]');

        $this
            ->makeSimpleCheckboxes()
            ->last('input')
            ->hasAttribute('name', 'my-name[]');
    }

    public function testSelectsCurrentValue(): void
    {
        $this
            ->makeSimpleCheckboxes()
            ->first('#my-id_2')
            ->hasAttribute('checked', 'checked');
    }

    public function testSelectsCurrentValues(): void
    {
        // TODO check for values, and value
        $this
            ->makeConditionalCheckboxes()
            ->first('#my-name_3')
            ->hasAttribute('checked', 'checked');
    }

    public function testSimpleOptionsHasValue(): void
    {
        $this->makeSimpleCheckboxes()
            ->first('div .govuk-checkboxes__item input')
            ->hasAttribute('value', 'value-one');

        $this->makeSimpleCheckboxes()
            ->last('div .govuk-checkboxes__item input')
            ->hasAttribute('value', 'value-three');
    }

    public function testSimpleOptionsHasLabel(): void
    {
        $this->makeSimpleCheckboxes()
            ->first('div .govuk-checkboxes__item label')
            ->contains('Option one');

        $this->makeSimpleCheckboxes()
            ->last('div .govuk-checkboxes__item label')
            ->contains('Option three');
    }

    public function testComplexOptionsHasValue(): void
    {
        $this->makeConditionalCheckboxes()
            ->first('div .govuk-checkboxes__item input')
            ->hasAttribute('value', 'value-one');
    }

    public function testComplexOptionsHasLabel(): void
    {
        $this->makeConditionalCheckboxes()
            ->first('div .govuk-checkboxes__item label')
            ->contains('Option one');
    }

    public function testComplexOptionsHasHint(): void
    {
        $this->makeConditionalCheckboxes()
            ->first('div .govuk-hint')
            ->contains('Hint one');
    }

    public function testComplexOptionsHasExclusive(): void
    {
        $this->makeConditionalCheckboxes()
            ->first('.govuk-checkboxes__item input')
            ->hasAttribute('data-behaviour', 'exclusive');
    }

    public function testConditionalHasName(): void
    {
        $this->makeConditionalCheckboxes()
            ->first('.govuk-checkboxes__conditional input')
            ->hasAttribute('name', 'conditional-one');
    }

    public function testConditionalHasLabel(): void
    {
        $this->makeConditionalCheckboxes()
            ->first('.govuk-checkboxes__conditional label')
            ->contains('Conditional one');
    }

    public function testHasDivider(): void
    {
        $this->makeConditionalCheckboxes()
            ->last('div .govuk-checkboxes__divider')
            ->contains('or');
    }

    public function testStylesLabelAsTitle(): void
    {
        $this->makeConditionalCheckboxes()
            ->first('legend h1')
            ->contains('My label');
    }

    protected function makeSimpleCheckboxes(): ViewAssertion
    {
        $this->setViewAttributes();
        $this->setViewErrors();

        return $this->assertView('govuk::components.checkboxes', [
            'hint' => 'My hint',
            'id' => 'my-id',
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

    protected function makeConditionalCheckboxes(): ViewAssertion
    {
        $this->setViewAttributes();
        $this->setViewErrors();

        return $this->assertView('govuk::components.checkboxes', [
            'isTitle' => true,
            'label' => 'My label',
            'name' => 'my-name',
            'options' => [
                'value-one' => [
                    'exclusive' => true,
                    'hint' => 'Hint one',
                    'label' => 'Option one',
                    'inputs' => [
                        [
                            'label' => 'Conditional one',
                            'name' => 'conditional-one',
                        ],
                    ],
                ],
                'divider-one' => [
                    'divider' => true,
                    'label' => 'or',
                ],
                'value-two' => 'Option two',
            ],
            'value' => [
                'value-two',
            ],
        ]);
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class EditFormRouteTest extends TestCase
{
    protected FormModel $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();
        $this->useForms();

        $this->subject = FormModel::factory()->create();
    }

    public function testGetsFormEditUrl(): void
    {
        $this->assertEquals(
            route('forms.edit', [TestForm::key(), $this->subject->id]),
            FormModel::editFormRoute($this->subject),
        );
    }
}

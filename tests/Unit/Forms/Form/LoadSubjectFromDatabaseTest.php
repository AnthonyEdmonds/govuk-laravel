<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class LoadSubjectFromDatabaseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->useDatabase();
    }

    public function testLoadsSubjectFromDatabase(): void
    {
        $subject = FormModel::factory()->create();
        
        $form = new TestForm();
        
        $this->assertEquals(
            $subject->id,
            $form->loadSubjectFromDatabase($subject->id)->id,
        );
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Question;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ValidateTest extends TestCase
{
    protected FirstQuestion $question;

    protected Request $request;

    protected FormModel $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new FirstQuestion();

        $this->request = new Request([
            'name' => null,
        ]);

        $this->subject = FormModel::factory()->make();
    }

    public function testRunsValidation(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The name field is required.');

        $this->question->validate($this->request, $this->subject);
    }
}

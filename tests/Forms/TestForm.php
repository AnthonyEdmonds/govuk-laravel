<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class TestForm extends Form
{
    public const KEY = 'report';
    
    public const BASE_ROUTE_NAME = 'breaches';
    
    public const STEPS = [
        'before-section' => TestFormStepQuestions::class,
        [
            'inside-section' => TestFormStepQuestion::class,
            'other-inside' => TestFormStepQuestions::class,
        ],
        'after-section' => TestFormStepQuestion::class,
        'outside-section' => TestFormStepQuestions::class,
    ];

    public static function authorize(?Model $user, string $ability): bool
    {
        // TODO: Implement authorize() method.
    }

    public static function exit(): RedirectResponse
    {
        // TODO: Implement exit() method.
    }

    public static function submit(): RedirectResponse
    {
        // TODO: Implement submit() method.
    }
}

<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Models;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Traits\HasForm;
use Illuminate\Database\Eloquent\Model;

class FormModel extends Model
{
    use HasForm;

    public $timestamps = false;

    public static function formClass(): string
    {
        return TestForm::class;
    }
}

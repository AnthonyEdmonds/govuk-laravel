<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Database\Factories;

use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormModelFactory extends Factory
{
    protected $model = FormModel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}

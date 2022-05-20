<?php

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use Illuminate\Support\Facades\Route;

Route::prefix('/breaches')
    ->name('breaches.')
    ->group(function () {
        Route::govukForm(TestForm::class);
    });

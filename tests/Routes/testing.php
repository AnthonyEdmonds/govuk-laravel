<?php

use Illuminate\Support\Facades\Route;

Route::prefix('my-form')
    ->group(function () {
        Route::govukForm(\AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm::class);
    });

<?php

use AnthonyEdmonds\GovukLaravel\Forms\FormController;
use Illuminate\Support\Facades\Route;

Route::prefix('/{form}')
    ->name('govuk-form.')
    ->controller(FormController::class)
    ->group(function () {
        Route::get('/start', 'start')->name('start');
        Route::get('/tasks', 'tasks')->name('tasks');
        Route::get('/summary', 'summary')->name('summary');
        Route::post('/submit', 'submit')->name('submit');
        Route::get('/confirmation', 'confirmation')->name('confirmation');

        Route::prefix('/{step}')
            ->group(function () {
                Route::get('/', 'create')->name('create');
                Route::post('/', 'store')->name('store');

                Route::get('/edit', 'edit')->name('edit');
                Route::put('/edit', 'update')->name('update');
            });
    });
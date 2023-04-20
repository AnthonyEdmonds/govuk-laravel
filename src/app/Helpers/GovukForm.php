<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

use AnthonyEdmonds\GovukLaravel\Exceptions\FormExpiredException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class GovukForm
{
    public static function has(string $key): bool
    {
        return Session::has($key);
    }

    public static function put(string $key, Model $form): void
    {
        Session::put($key, $form);
    }

    public static function get(string $key): Model
    {
        if (self::has($key) === false) {
            throw new FormExpiredException('The form you are trying to access has expired. Please start again.');
        }

        return Session::get($key);
    }

    public static function clear(string $key): void
    {
        Session::forget($key);
    }
    
    public static function flash(string $key, Model $form): void
    {
        Session::flash($key, $form);
    }
}

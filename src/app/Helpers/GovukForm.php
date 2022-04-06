<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

use ErrorException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

/* Models can be created over several form steps using the User's session */
class GovukForm
{
    /* Put a form model into the User's session */
    public static function set(string $key, Model|array $form): void
    {
        Session::put($key, $form);
    }

    /* Retrieve a form model from the User's session */
    public static function get(string $key): Model|array
    {
        if (Session::has($key) === false) {
            throw new ErrorException('The form you are trying to access has expired. Please start again.');
        }

        return Session::get($key);
    }

    /* Clear a form from the User's session */
    public static function clear(string $key): void
    {
        Session::forget($key);
    }
}

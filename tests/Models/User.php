<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class User implements AuthenticatableContract
{
    use Authenticatable;
}

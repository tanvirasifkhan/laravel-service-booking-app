<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface AuthenticationInterface
{
    public function authenticate(array $credentials): Model;
}

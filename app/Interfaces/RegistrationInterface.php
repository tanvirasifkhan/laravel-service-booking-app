<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface RegistrationInterface
{
    public function register(array $credentials): Model;
}

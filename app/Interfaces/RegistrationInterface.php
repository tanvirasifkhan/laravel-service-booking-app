<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface RegistrationInterface
{
    public function register(array $credentials): void;
}

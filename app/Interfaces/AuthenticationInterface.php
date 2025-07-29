<?php

namespace App\Interfaces;

interface AuthenticationInterface
{
    public function authenticate(array $credentials): bool;
}

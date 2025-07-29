<?php

namespace App\Repositories;

use App\Interfaces\AuthenticationInterface;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticationRepository implements AuthenticationInterface
{
    /**
     * Authenticate the admin user.
     *
     * @param array $credentials
     * @return bool
     */
    public function authenticate(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }
}
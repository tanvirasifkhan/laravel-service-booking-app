<?php

namespace App\Repositories;

use App\Interfaces\AuthenticationInterface;
use App\Interfaces\LogoutInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuthenticationRepository implements AuthenticationInterface, LogoutInterface
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

    /**
     * Logout the admin user.
     * 
     * @return bool
     */
    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
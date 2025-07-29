<?php

namespace App\Repositories;

use App\Interfaces\AuthenticationInterface;
use App\Interfaces\LogoutInterface;
use App\Models\User;
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
    public function authenticate(array $credentials): User
    {
        return User::where("email", $credentials["email"])->first();        
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
<?php

namespace App\Repositories;

use App\Interfaces\AuthenticationInterface;
use App\Interfaces\LogoutInterface;
use App\Interfaces\RegistrationInterface;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerAuthenticationRepository implements AuthenticationInterface, LogoutInterface, RegistrationInterface
{

    /**
     * Register a new customer.
     * 
     * @param array $credentials
     * 
     * @return Customer
     */
    public function register(array $credentials): Customer
    {
        return Customer::create($credentials);
    }

    /**
     * Authenticate the admin user.
     *
     * @param array $credentials
     * @return Customer
     */
    public function authenticate(array $credentials): Customer
    {
        return Customer::where("email", $credentials["email"])->first();        
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
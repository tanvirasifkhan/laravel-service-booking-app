<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface LogoutInterface
{
    public function logout(Request $request): void;
}

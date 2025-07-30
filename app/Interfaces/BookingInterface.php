<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface BookingInterface
{
    public function all(): Builder;
}

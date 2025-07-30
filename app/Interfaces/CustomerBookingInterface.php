<?php

namespace App\Interfaces;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder;

interface CustomerBookingInterface
{
    public function create(array $bookingData): Booking;
}

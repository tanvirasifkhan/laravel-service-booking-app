<?php

namespace App\Repositories;

use App\Interfaces\BookingInterface;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder;

class AdminBookingRepository implements BookingInterface
{
    /**
     * Fetch all services.
     * 
     * @return Builder
     */
    public function all(): Builder
    {
        return Booking::query()->orderBy('id', 'DESC');
    }
}
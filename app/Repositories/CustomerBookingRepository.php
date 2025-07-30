<?php

namespace App\Repositories;

use App\Interfaces\BookingInterface;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder;

class CustomerBookingRepository implements BookingInterface
{
    /**
     * Fetch all services.
     * 
     * @return Builder
     */
    public function all(): Builder
    {
        return Booking::query()->where('customer_id', auth()->id())->orderBy('id', 'DESC');
    }
}
<?php

namespace App\Repositories;

use App\Interfaces\BookingInterface;
use App\Interfaces\CustomerBookingInterface;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder;

class CustomerBookingRepository implements BookingInterface, CustomerBookingInterface
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

    /**
     * create a new booking.
     * 
     * @return Booking
     */
    public function create(array $bookingData): Booking
    {
        return Booking::create($bookingData);   
    }
}
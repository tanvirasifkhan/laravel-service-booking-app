<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => Carbon::now()->format('Y-m-d'),
            'customer_id' => fake()->randomElement(Customer::pluck('id')),
            'service_id' => fake()->randomElement(Service::pluck('id')),
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled'])
        ];
    }
}

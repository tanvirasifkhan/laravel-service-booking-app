<?php

namespace Database\Seeders;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks=0");

        Booking::truncate();

        Booking::insert([
            [
                'date' => Carbon::now()->format('Y-m-d'),
                'customer_id' => 1,
                'service_id' => 1,
                'status' => 'pending'
            ],
            [
                'date' => Carbon::now()->format('Y-m-d'),
                'customer_id' => 2,
                'service_id' => 2,
                'status' => 'confirmed'
            ]
        ]);
    }
}

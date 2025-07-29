<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks=0");

        Customer::truncate();

        Customer::insert([
            [
                'name' => 'Asif Khan',
                'email' => 'asif@gmail.com',
                'phone' => '1234567890',
                'address' => 'Dhaka, Bangladesh',
                'password' => bcrypt('asifkhan')
            ],
            [
                'name' => 'Tanvir Ahmed',
                'email' => 'tanvir@gmail.com',
                'phone' => '1234567812',
                'address' => 'Chittagong, Bangladesh',
                'password' => bcrypt('tanvir')
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks=0");

        Service::truncate();

        Service::insert([
            [
                'name' => 'Web Development',
                'description' => 'We provide top-notch web development services to build robust and scalable web applications.',
                'price' => 3000.00,
                'status' => 'active'
            ],
            [
                'name'=> 'Mobile App Development',
                'description'=> 'We specialize in creating user-friendly mobile applications for both Android and iOS platforms.',
                'price'=> 1500.00,
                'status'=> 'inactive'
            ],
            [
                'name'=> 'Digital Marketing',
                'description'=> 'Our digital marketing services help businesses grow their online presence and reach their target audience effectively.',
                'price'=> 800.00,
                'status'=> 'active'
            ],
            [
                'name'=> 'Graphic Design',
                'description'=> 'We offer creative graphic design services to enhance your brand identity and visual communication.',
                'price'=> 500.00,
                'status'=> 'active'
            ],
            [
                'name'=> 'SEO Services',
                'description'=> 'Our SEO experts optimize your website to improve its visibility on search engines and drive organic traffic.',
                'price'=> 1200.00,
                'status'=> 'inactive'
            ]
        ]);
    }
}

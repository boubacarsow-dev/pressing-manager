<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::factory(10)->create();
        Service::factory()->services_with_items(3)->create();
    }
}

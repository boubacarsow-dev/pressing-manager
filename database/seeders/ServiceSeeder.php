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
        
        Service::factory()
        ->count(3)
        ->hasAttached(Item::factory()->count(3),
        fn()=>['prix_applique'=> fake()->numberBetween(100,10000)])
        ->create();
    }
}

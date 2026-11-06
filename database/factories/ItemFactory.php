<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->name()
        ];
    }

    public function items_with_services(int $nombre =4):static{
        return $this->hasAttached(Service::factory()->count($nombre),
    fn() => ['prix_applique' =>fake()->numberBetween(1000,5000)]);
    }
    
}

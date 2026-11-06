<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle' => fake()->sentence(4),
            'description' => fake()->text(250),
            'tarif' => fake()->numberBetween(200,10000),
            'actif' => fake()->boolean(70)
        ];
    }
    
    public function services_with_items(int $nombre =4):static{
        return $this->hasAttached(Item::factory()->count($nombre),
    fn() => ['prix_applique' =>fake()->numberBetween(1000,5000)]);
    }

}

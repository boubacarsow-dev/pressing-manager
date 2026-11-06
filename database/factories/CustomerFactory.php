<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    

    public function definition(): array
    {
        return [
            'nom' =>fake()->name(),
            'tel' => fake()->phoneNumber(),
            'adresse' => fake()->address()
        ];
    }

     public function customer_with_orders(int $nombre = 4):static{
        return $this->has(Order::factory()->count($nombre));
     }
   

}

<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ref' => fake()->bothify('REF-???-####'),
            'date_depot' => fake()->dateTime(),
            'livraison_prev' => fake()->dateTime(),
            'date_recup' => fake()->dateTime(),
            'montant_total' => fake()->numberBetween(1000,30000),
            'statut' => fake()->randomElement(['reçue','en traitement','prête','récupérée']),
            'customer_id' => Customer::factory(),
        ];
    }
     
    public function order_with_payments(int $nombre = 3):static{
        return $this->has(Payment::factory()->count($nombre));
    }
   
}

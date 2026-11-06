<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'montant' => fake()->numberBetween(1000,10000),
            'date_paiement' => fake()->dateTime(),
            'order_id' => Order::factory(),
        ];
    }

     /**
     * Indicate that the model's email address should be unverified.
     */
    

}

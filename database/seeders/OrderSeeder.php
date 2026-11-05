<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Order::factory(10)->create();
        Order::factory()
            ->count(10)
            ->for(Customer::factory())
            ->create();
            
        Order::factory()
        ->count(3)
        ->for(Customer::factory())
        ->has(Payment::factory()->count(3))
        ->create();
    }
}

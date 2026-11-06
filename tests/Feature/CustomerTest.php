<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
     use RefreshDatabase;
    

    public function tester_ajout_client(){
        $customer = Customer::factory()->create();
        $this->assertDatabaseHas('customers',[
            'id' =>$customer->id,
            'nom' =>$customer->nom,
            'tel' => $customer->tel,
            'adresse' =>$customer->adresse
        ]);
    }
    
}

<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RelationTest extends TestCase
{
    use RefreshDatabase;
   
    public function testCustomerOrders(){
        $customer = Customer::factory()->customer_with_orders(5)->create();
        $this->assertCount(5,$customer->orders);
        $this->assertTrue($customer->orders->first()->customer->id === $customer->id );
    }
    
    public function testOrderPayments(){
        $order = Order::factory()->order_with_payments(3)->create();
        $this->assertCount(3,$order->payments);
        $this->assertNotNull($order->customer);
    }

    public function testItemsServices(){
        $item = Item::factory()->items_with_services(4)->create();
        $this->assertCount(4,$item->services);
        $this->assertNotNull($item->services->first()->pivot->prix_applique);
    }

    public function testServicesItems(){
        $service = Service::factory()->services_with_items(4)->create();
        $this->assertCount(4,$service->items);
        $this->assertNotNull(!$service->items->first()->pivot->prix_applique);
    }
}

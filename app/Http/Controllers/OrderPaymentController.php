<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public function store(StorePaymentRequest $request, Order $order){
         $order->payments()->create($request->validated());
         return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Paiement enregistré avec succès.');
    }
}
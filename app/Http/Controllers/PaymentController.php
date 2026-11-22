<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    // le controller
    public function index():View{
        $payments = Payment::with('order.customer')->latest()->paginate(10);
        return view('payments.index',compact('payments'));
    }

    public function show(Payment $payment):View{
        $payment->load('order.customer');
        return view('payments.show', compact('payment'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    // lister les customers
    public function index(Request $request):View{
        $customers = Customer::when($request->input('search'),function($query,$search){
            return $query->where('nom','like',"%{$search}%");
        })->latest()->paginate(10);
        return view('customers.index',['customers' =>$customers]);
    }

    // creation
    public function create():View{
        return view('customers.create'); 
    }

    // 
    public function store(CustomerRequest $request){   
        Customer::create($request->validated());
        return redirect()->route('customers.index')->with('success', 'client cree avec success');
    }

    public function update(CustomerRequest $request,Customer $customer){
        $customer->update($request->validated());
        return redirect()->route('customers.show',$customer)->with('success','Informations du client mis a jour');
    }

        public function edit(Customer $customer){
            return view('customers.edit', compact('customer'));
        }
    public function show(Customer $customer):View{
        $customer->load('orders.items');
        return view('customers.show', ['customer' =>$customer]);
    }

    public function destroy(Customer $customer){
        $customer->delete();
        return redirect()->route('customers.index')->with('success','Client supprime avec success');
    }
}
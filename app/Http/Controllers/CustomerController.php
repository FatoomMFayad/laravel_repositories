<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('name')
        ->where('active', 1)->with('user')
        ->get()
        ->map(function ($customer){
            return [
                'customer_id' => $customer->id,
                'name' => $customer->name,
                'created_by' => $customer->user->email,
                'last_updated' => $customer->updated_at->diffForHumans(),
            ];
        });
        return $customers;
    }
}

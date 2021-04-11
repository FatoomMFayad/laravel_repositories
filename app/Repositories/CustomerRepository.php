<?php


namespace App\Repositories;


use App\Models\Customer;

class CustomerRepository
{
    public function all()
    {
        return Customer::orderBy('name')
            ->where('active', 1)->with('user')
            ->get()
            ->map->format();
    }

    public function findById($customerId)
    {
        return $customer =  Customer::where('Id', $customerId)
            ->where('active', 1)
            ->with('user')
            ->firstOrFail()
            ->format();
    }
}

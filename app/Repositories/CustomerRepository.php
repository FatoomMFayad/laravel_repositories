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
            ->map(function ($customer){
                return $this->formatCustomer($customer);
            });
    }

    public function findById($customerId)
    {
        $customer =  Customer::where('Id', $customerId)
            ->where('active', 1)
            ->with('user')
            ->firstOrFail();
        return $this->formatCustomer($customer);
    }

    protected function formatCustomer($customer)
    {
            return [
                'customer_id' => $customer->id,
                'name' => $customer->name,
                'created_by' => $customer->user->email,
                'last_updated' => $customer->updated_at->diffForHumans(),
            ];

    }


}

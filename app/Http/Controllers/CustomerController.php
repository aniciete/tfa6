<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display the customer accounts directory populated via Eloquent ORM.
     */
    public function index(): View
    {
        $customers = Customer::query()->orderBy('id')->get();

        return view('customers.index', [
            'title'      => 'Customer Accounts | POS Eloquent',
            'activePage' => 'customers',
            'customers'  => $customers,
        ]);
    }
}

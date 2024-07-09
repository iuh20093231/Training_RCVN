<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tittle = 'Customer';
        $customer = Customer::all();
        return view('custormer.index',compact("tittle","customer"));
    }
    public function getCustomer(Request $request)
    {
        try {
            $query = Customer::query();

            if ($request->filled('customer_name')) {
            $query->where('customer_name', 'like', '%' . $request->customer_name . '%');
            }

            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }

            if ($request->filled('is_active')) {
                $query->where('is_active', $request->is_active);
            }

            if ($request->filled('address')) {
                $query->where('address', 'like', '%' . $request->address . '%');
            }

            $customer = $query->orderBy('created_at', 'desc')->paginate(20);

            return response()->json($customer);

        } catch (\Exception $e) {
            \Log::error('Error fetching customer: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tittle = 'Add customer';
        return view('custormer.add',compact('tittle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        if($request->has('is_active'))
        {
            $is_active = 1;
        }
        else
        {
            $is_active = 0;
        }
        Customer::create([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'tel_num' => $request->tel_num,
            'address' => $request->address,
            'is_active' => $is_active,
            'created_at' => now()
        ]);
        return redirect()->route('custormer.index')->with('success', 'Người dùng đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $custormer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $custormer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $custormer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Custormer $custormer)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomerExport;  
use App\Imports\CustomerImport;        
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Exception;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tittle = 'Customer';
        //$query = Customer::query();
        $customer = Customer::popular();
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
    public function show($id)
    {
       $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    public function update(Request $request,$id)
    {
        try {
            $request->validate([
                'customer_name' => 'required|string|min:5',
                'email' => 'required|string|email|max:255'. $id,
                'tel_num' => 'required|string|regex:/^[0-9]{10,15}$/',
                'address' => 'required',
            ]);

            $customer = Customer::findOrFail($id);

            $customer->update([
                'customer_name' => $request->customer_name,
                'email' => $request->email,
                'tel_num' => $request->tel_num,
                'address' => $request->address,
            ]);

            return response()->json($customer);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Customer not found'], 404);
        } catch (\Exception $e) {
            \Log::error('Error updating customer: '.$e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
    public function import(Request $request)
    {

        Excel::import(new CustomerImport, $request->file('file'));
        return back();
    }
    public function export(Request $request)
    {
        try {
            $customer_name = $request->input('customer_name');
            $customer = Customer::where('customer_name','like','%'.$customer_name.'%')->get()->toArray();
            //dd($customer);
            return Excel::download(new CustomerExport( $customer), 'customer.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
            'charset' => 'UTF-8',
            'encoding' => 'UTF-8-BOM',
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully']);
    }
}

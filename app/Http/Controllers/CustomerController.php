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
    public function index()
    {
        $tittle = 'Customer';
        $customer = Customer::popular();
        return view('custormer.index',compact("tittle","customer"));
    }
    public function getCustomer(Request $request)
    {
            $query = Customer::query();

            if ($request->filled('customer_name')) {
                $query->customerNameLike($request->customer_name);
            }

            if ($request->filled('email')) {
                $query->emailLike($request->email);
            }

            if ($request->filled('is_active')) {
                $query->isActive($request->is_active);
            }

            if ($request->filled('address')) {
                $query->addressLike($request->address);
            }
            $customers = $query->orderBy('created_at', 'desc')->paginate(20);
            return response()->json($customers);
    }
    public function create()
    {
        $tittle = 'Add customer';
        return view('custormer.add',compact('tittle'));
    }
    public function store(CustomerRequest $request)
    {
        $is_active = $request->has('is_active') && $request->is_active ? 1 : 0;
        $customer = Customer::create([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'tel_num' => $request->tel_num,
            'address' => $request->address,
            'is_active' => $is_active,
            'created_at' => now()
        ]);
        return response()->json($customer);
    }
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    public function update(CustomerRequest $request,$id)
    {
            $data = $request->validated();
            $customer = Customer::findOrFail($id);
            $customer->update($data);
            return response()->json($customer);
    }
    public function import(Request $request)
    {
        $import = new CustomerImport;
        Excel::import($import, $request->file('file'));

        $failures = $import->getFailures();
        if (!empty($failures)) {
            return response()->json(['errors' => $failures], 422);
        }

        return response()->json(['message' => 'File imported successfully']);
    }
    public function export(Request $request)
    {
            $query = Customer::query();

            if ($request->filled('customer_name')) {
                $query->customerNameLike($request->customer_name);
            }

            if ($request->filled('email')) {
                $query->emailLike($request->email);
            }

            if ($request->filled('is_active')) {
                $query->isActive($request->is_active);
            }

            if ($request->filled('address')) {
                $query->addressLike($request->address);
            }

            $customers = $query->get()->take(20);
            return Excel::download(new CustomerExport($customers), 'customer.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
            'charset' => 'UTF-8',
            'encoding' => 'UTF-8-BOM',
            ]);
    }
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(['message' => 'Xóa khách hàng thành công']);
    }
}

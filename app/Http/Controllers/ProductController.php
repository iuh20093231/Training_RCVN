<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tittle = 'Product';
        $query = Product::query();
        $product = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('Product.index', compact("tittle","product"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getProduct(Request $request)
    {
        try {
            $query = Product::query();

            if ($request->filled('product_name')) {
                $query->where('product_name', 'like', '%' . $request->product_name . '%');
            }

            if ($request->filled('is_sales')) {
                $query->where('is_sales',$request->is_sales);
            }
            if ($request->filled('product_price_to') && $request->filled('product_price_end')) {
                $query->whereBetween('product_price', [$request->product_price_to, $request->product_price_end]);
            }
            $product = $query->paginate(20);

            return response()->json($product);

        } catch (\Exception $e) {
            \Log::error('Error fetching customer: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function create()
    {
        $tittle = 'Add Product';
        $query = Product::query();
        $product = $query->orderBy('created_at', 'desc');
        return view('Product.add', compact('tittle','product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

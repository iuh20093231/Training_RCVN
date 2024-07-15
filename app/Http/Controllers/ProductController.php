<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
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
            $product = $query->orderBy('created_at', 'desc')->paginate(20);

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
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->product_id= Product::generateProductId();
        $product->product_name= $request->product_name;
        if($request->hasFile('product_image')){
            $file = $request->file('product_image');
            $path = $file->store('images','public');
            $product->product_image = $path;
        }
        $product->product_price = $request->product_price;
        $product->description = $request->description;
        $product->is_sales = $request->is_sales;
        $product->created_at=now();
        $product->save();
        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được lưu thành công.');
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
    public function edit($product_id)
    {
        $product = Product::find($product_id);
        $tittle = 'Update Product';
        return view('Product.edit',compact('product','tittle'));
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request,$product_id)
    {
        $product = Product::find($product_id);
        if(isset($request->product_image)) {
                $file = $request->file('product_image');
                $path = $file->store('images','public');
                $product->product_image = $path;
        }
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->description = $request->description;
        $product->is_sales = $request->is_sales;
        $product->save();
        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id)
    {
        $product = Product::find($product_id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}

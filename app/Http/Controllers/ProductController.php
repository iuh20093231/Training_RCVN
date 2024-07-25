<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{

    public function index()
    {
        $tittle = 'Product';
        $product = Product::popular();
        return view('Product.index', compact("tittle","product"));
    }
    public function getProduct(Request $request)
    {
            $query = Product::query();

            if ($request->filled('product_name')) {
                $query->productNameLike($request->product_name);
            }

            if ($request->filled('is_sales')) {
                $query->isSales($request->is_sales);
            }

            if ($request->filled('product_price_to') && $request->filled('product_price_end')) {
                $query->priceRange($request->product_price_to, $request->product_price_end);
            }
            $product = $query->orderBy('created_at', 'desc')->paginate(20);

            return response()->json($product);
    }
    public function create()
    {
        $tittle = 'Add Product';
        return view('Product.add', compact('tittle'));
    }

    public function store(ProductRequest $request)
    {
        $product = new Product();
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

    public function edit($product_id)
    {
        $product = Product::find($product_id);
        $tittle = 'Update Product';
        return view('Product.edit',compact('product','tittle'));
    } 
    public function update(ProductRequest $request,$product_id)
    {
        $product = Product::find($product_id);
        if ($request->has('remove_image')) {
            if ($request->remove_image && $product->product_image) {
                Storage::delete('public/' . $product->product_image);
                $product->product_image = null;
            }
        }
        if ($request->hasFile('product_image')) {

            $imagePath = $request->file('product_image')->store('public/images');
            $product->product_image = str_replace('public/', '', $imagePath);
        }
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->description = $request->description;
        $product->is_sales = $request->is_sales;
        $product->save();
        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }
    public function destroy($product_id)
    {
        $product = Product::find($product_id);
        $product->delete();
        return response()->json(['message' => 'Xóa sản phẩm thành công']);
    }
}

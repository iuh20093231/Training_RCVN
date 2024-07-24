<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 
class Product extends Model
{
    use HasFactory;
    protected $table = 'mst_product';
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'product_id',
        'product_name',
        'product_image',
        'product_price',
        'is_sales',
        'description',
        'created_at',
        'updated_at'
    ];
    // Tạo ID sản phẩm
    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->product_id = self::generateProductId($product->product_name);
        });
    }

    private static function generateProductId($name)
    {
        $firstChar = strtoupper(substr($name, 0, 1)); 
        $latestProduct = self::where('product_id', 'LIKE', $firstChar . '%')->orderBy('product_id', 'desc')->first();

        if ($latestProduct) {
            $lastIdNumber = (int)substr($latestProduct->product_id, 1); 
            $newIdNumber = str_pad($lastIdNumber + 1, 9, '0', STR_PAD_LEFT); 
        } else {
            $newIdNumber = str_pad(1, 9, '0', STR_PAD_LEFT); 
        }

        return $firstChar . $newIdNumber;
    }
    public function scopePopular($query)
    {
        return $query->orderBy('created_at', 'desc')->paginate(20);
    }
    public function scopeProductNameLike($query, $productName)
    {
        return $query->where('product_name', 'like', '%' . $productName . '%');
    }

    public function scopeIsSales($query, $isSales)
    {
        return $query->where('is_sales', $isSales);
    }

    public function scopePriceRange($query, $from, $to)
    {
        return $query->whereBetween('product_price', [$from, $to]);
    }
}

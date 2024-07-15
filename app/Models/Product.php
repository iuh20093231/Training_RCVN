<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 
class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
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
    public static function generateProductId()
    {
        $maxId = DB::table('product')->max(DB::raw('CAST(SUBSTRING(product_id, 3, 3) AS UNSIGNED)'));
        $newId = $maxId ? $maxId + 1 : 1;
        return 'SP' . str_pad($newId, 3, '0', STR_PAD_LEFT);
    }
    public function scopePopular($query)
    {
        return $query->orderBy('created_at', 'desc')->paginate(20);
    }
}

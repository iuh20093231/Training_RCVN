<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'product_id';
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
}

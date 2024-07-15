<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'custormers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_name',
        'email',
        'tel_num',
        'address',
        'is_active',
        'created_at',
    ];
    public function scopePopular($query)
    {
       return $query->orderBy('created_at', 'desc')->paginate(20);
    }
}
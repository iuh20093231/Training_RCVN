<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'custormer';
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'customer_id',
        'customer_name',
        'email',
        'tel_num',
        'address',
        'is_active',
        'created_at',
        'updated_at'
    ];
}

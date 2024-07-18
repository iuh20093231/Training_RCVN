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
    public function scopeCustomerNameLike($query, $customerName)
    {
        return $query->where('customer_name', 'like', '%' . $customerName . '%');
    }

    public function scopeEmailLike($query, $email)
    {
        return $query->where('email', 'like', '%' . $email . '%');
    }

    public function scopeIsActive($query, $isActive)
    {
        return $query->where('is_active', $isActive);
    }

    public function scopeAddressLike($query, $address)
    {
        return $query->where('address', 'like', '%' . $address . '%');
    }
}

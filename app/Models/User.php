<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'last_login_at',
        'last_login_ip',
        'update_at',
        'remember_token',
        'created_at',
        'group_role',
        'is_active',
        'is_delete',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function scopePopular($query)
    {
        return $query->where('is_delete',0)->orderBy('created_at', 'desc')->paginate(20);
    }
    public function scopeNameLike($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    public function scopeEmailLike($query, $email)
    {
        return $query->where('email', 'like', '%' . $email . '%');
    }

    public function scopeGroupRole($query, $groupRole)
    {
        return $query->where('group_role', $groupRole);
    }

    public function scopeIsActive($query, $isActive)
    {
        return $query->where('is_active', $isActive);
    }
    public function scopeNotDeleted($query)
    {
        return $query->where('is_delete', 0);
    }
}

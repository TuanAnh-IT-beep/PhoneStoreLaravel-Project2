<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    use \Illuminate\Auth\Authenticatable;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = ['username', 'password', 'icon', 'full_name', 'email', 'phone', 'role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function orders(){
        return $this->hasMany(Order::class,'customer_id','id');
    }
    public function hasPermission($permission) {
        return $this->role()->hasPermission($permission);
    }
}

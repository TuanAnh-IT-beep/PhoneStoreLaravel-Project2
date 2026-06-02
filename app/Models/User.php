<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasRoles;
    protected $table = 'users';
    protected $guard_name = 'admin';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'password', 'icon', 'full_name', 'email', 'phone'];
    public function orders(){
        return $this->hasMany(Order::class,'customer_id','id');
    }
}

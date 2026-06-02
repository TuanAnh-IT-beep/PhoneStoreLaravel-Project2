<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'password', 'icon', 'display_name', 'email', 'phone', 'gender', 'birthday', 'address'];
    public $timestamps = true;
    public function orders(){
        return $this->hasMany(Order::class,'customer_id','id');
    }
}

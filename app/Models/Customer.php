<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'password', 'icon', 'display_name', 'email', 'phone', 'birthday', 'address'];
    public $timestamps = true;
    public function orders(){
        return $this->hasMany(Order::class,'customer_id','id');
    }
}

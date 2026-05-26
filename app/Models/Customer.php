<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model implements Authenticatable
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'password', 'icon', 'display_name', 'email', 'phone', 'gender', 'birthday', 'address'];
    public $timestamps = true;
    public function orders(){
        return $this->hasMany(Order::class,'customer_id','id');
    }
}

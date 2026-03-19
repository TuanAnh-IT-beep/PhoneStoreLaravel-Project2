<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $table='orders';
    protected $primarykey='id';
    protected $fillable=['customer_id','payment_method_id','receiver','address','phone','note','ship_track_id','ship_fee','total_price','ship_expect_date','status'];
    public $timestamp=true;
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function payment(){
        return $this->belongsTo(PaymentMethod::class);
    }
    public function orderdetails(){
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }
}

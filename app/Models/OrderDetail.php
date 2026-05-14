<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /** @use HasFactory<\Database\Factories\OrderDetailFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $table='order_details';
    protected $fillable=['quantity','total','order_id','subproduct_id'];
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function subproduct(){
        return $this->belongsTo(Subproduct::class);
    }
}

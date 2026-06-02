<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subproduct extends Model
{
    /** @use HasFactory<\Database\Factories\SubproductFactory> */
    use HasFactory;

    protected $table = 'subproducts';

    protected $primarykey = 'id';

    protected $fillable = ['product_id', 'name', 'thumbnail_path', 'price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sub_specs()
    {
        return $this->hasMany(SubSpec::class, 'subproduct_id', 'id');
    }

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class, 'subproduct_id', 'id');
    }

    public function name()
    {
        return $this->product->name
        . " " .
         $this->sub_specs->where('spec_id', 12)->first()?->value()
        . " " .
        $this->sub_specs->where('spec_id', 1)->first()?->value();
    }
}

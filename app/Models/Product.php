<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $table='products';
    protected $primarykey='id';
    protected $fillable=['name','description','thumbnail_path','overall_price','total_stock','category_id','manufacturer_id','released_date','featured'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }
    public function images(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    public function subproducts(){
        return $this->hasMany(Subproduct::class,'product_id','id');
    }
}

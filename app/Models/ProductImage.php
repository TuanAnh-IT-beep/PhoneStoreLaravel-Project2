<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /** @use HasFactory<\Database\Factories\ProductImageFactory> */
    use HasFactory;
    protected $table='Imagies';
    protected $primarykey='id';
    protected $fillable=['product_id','path','description'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}

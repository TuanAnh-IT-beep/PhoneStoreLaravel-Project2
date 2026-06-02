<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    /** @use HasFactory<\Database\Factories\ManufacturerFactory> */
    use HasFactory;
    protected $table = 'manufacturers';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'icon'];
    public $timestamps = false;
    public function products(){
        return $this->hasMany(Product::class,'manufacturer_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSpec extends Model
{
    /** @use HasFactory<\Database\Factories\SubSpecFactory> */
    use HasFactory;
    protected $table='subspecs';
    protected $fillable=['value','spec_id','product_id'];
    public function spec(){
        return $this->belongsTo(Spec::class);
    }
    public function subproduct(){
        return $this->belongsTo(Subproduct::class);
    }
}

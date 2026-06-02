<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    /** @use HasFactory<\Database\Factories\SpecFactory> */
    use HasFactory;
    protected $table = 'specs';
    protected $primaryKey = 'id';
    protected $fillable = ['name','suffix'];
    public $timestamps = false;
    public function sub_specs(){
        return $this->hasMany(SubSpec::class,'spec_id','id');
    }
}

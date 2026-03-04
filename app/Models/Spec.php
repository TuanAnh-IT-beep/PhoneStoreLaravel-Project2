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
    protected $fillable = ['name'];
    public $timestamps = false;
}

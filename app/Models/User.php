<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    protected $table='user';
    protected $primarykey='id';
    protected $fillable=['username','password_hash','icon','full_name','email','phone','role_id'];
    public function role(){
        return $this->belongsTo(Role::class);
    }
}

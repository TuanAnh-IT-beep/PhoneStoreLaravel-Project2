<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    public $timestamps = false;
    public function Users(){
        return $this->hasMany(User::class,'role_id','id');
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }
}

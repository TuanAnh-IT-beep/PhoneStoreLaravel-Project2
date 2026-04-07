<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /** @use HasFactory<\Database\Factories\PermissionFactory> */
    use HasFactory;
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description'];
    public $timestamps = false;
    public function rolepermissions(){
        return $this->hasMany(RolePermission::class,'permission_id','id');
    }
    public function roles(){
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id');
    }
}

<?php

namespace App\Models;

use App\Models\RolePermission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $table = 'roles';
    protected $fillable = ['name', 'status'];
    protected $hidden = ['updated_at', 'deleted_at'];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    
    public function role_permissions()
    {
        return $this->hasMany(RolePermission::class);
    }


}

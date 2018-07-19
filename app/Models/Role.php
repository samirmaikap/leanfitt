<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $fillable = [
    	'name',
    	'display_name',
    	'description',
    ];

    public function organization()
    {
        return $this->belongsToMany(Role::class, 'organization_role', 'role_id', 'organization_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationUser extends Model
{
    protected $table='organization_user';
    public $timestamps = false;
    protected $fillable=[
        'organization_id',
        'user_id',
        'is_suspended',
        'is_invited',
        'is_default',
        'invitation_token'
    ];
}

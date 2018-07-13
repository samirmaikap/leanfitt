<?php

namespace App\Models;

use function config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Permission\Models\Role;
use function url;

class Organization extends Model
{
    use Notifiable;
    use Billable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'featured_image',
        'contact_person',
        'is_archived',
        'subdomain',
    ];

    protected $appends = [
        'url',
    ];

    public function getUrlAttribute()
    {
        return url('http://' . $this->subdomain . config('session.domain') );
    }


    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'organization_user', 'organization_id', 'user_id')->withPivot('is_suspended');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'organization_role', 'organization_id', 'role_id');
    }

    public function project(){
        return $this->hasMany(Project::class);
    }

    public function report(){
        return $this->hasMany(Report::class);
    }
}

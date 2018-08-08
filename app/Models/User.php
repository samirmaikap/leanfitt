<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\Permission\Traits\HasRoles;
use App\Traits\UserAttributes;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use SoftDeletes;
    // use HasRoles;
    use UserAttributes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'avatar',
        'password',
        'verification_token',
        'is_verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'full_name',
        'initials',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'organization_user', 'user_id', 'organization_id')->withPivot('is_suspended', 'is_default');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class,'department_user','user_id','department_id');
    }

    public function item(){
        return $this->hasMany(ActionItem::class, 'assignor_id');
    }

    public function assignee(){
        return $this->hasMany(ActionItemAssignee::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function quizResult(){
        return $this->hasMany(QuizResult::class);
    }

    public function project(){
//        return $this->belongsTo(Project::class);
        return $this->hasMany(Project::class);
    }

    public function quiz(){
        return $this->hasMany(QuizResult::class);
    }

    public function award(){
        return $this->hasMany(Award::class);
    }

    public function projectActivity(){
        return $this->hasMany(ProjectActivity::class);
    }

    public function projectMember(){
        return $this->hasMany(ProjectMember::class);
    }

    public function userOrganization(){
        return $this->hasMany(OrganizationUser::class,'user_id','id');
    }

    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }


}

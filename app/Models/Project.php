<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable=[
        'organization_id',
        'name',
        'goal',
        'start_date',
        'end_date',
        'report_date',
        'note',
        'is_archived',
        'is_completed',
    ];

    public function kpi(){
        return $this->hasMany(KpiChart::class);
    }

    public function actionItem(){
        return $this->hasMany(ActionItem::class);
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function activity(){
        return $this->hasMany(ProjectActivity::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function attachments(){
        return $this->morphMany(Attachment::class,'attachable');
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function member(){
        return $this->hasMany(ProjectMember::class);
    }
}

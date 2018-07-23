<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionItem extends Model
{
    protected $fillable=[
        'title',
        'description',
        'process_id',
        'user_id',
        'position',
        'due_date',
        'is_archived',
    ];

    public function assignor()
    {
        return $this->belongsTo(User::class, 'user_id'); //assignor can be admin or employee
    }

//    public function board(){
//        return $this->belongsTo(Board::class);
//    }

    public function checklist(){
        return $this->hasMany(Checklist::class);
    }

    public function label(){
        return $this->hasMany(Label::class);
    }

    public function assignees(){
        return $this->hasMany(ActionItemAssignee::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function attachments(){
        return $this->morphMany(Attachment::class,'attachable');
    }

    public function assignments(){
        return $this->hasMany(ActionItemAssignment::class,'action_item_id','id');
    }

}

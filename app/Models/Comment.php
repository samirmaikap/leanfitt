<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $hidden=[
        'commentable_id',
        'commentable_type',
    ];

    protected $fillable=[
        'comment',
        'user_id',
        'commentable_id',
        'commentable_type',
    ];

    public function item(){
        return $this->belongsTo(ActionItem::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commentable(){
        return $this->morphTo();
    }

}

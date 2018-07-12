<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentResult extends Model
{
    protected $fillable=[
        'lean_tool_id',
        'user_id',
        'result'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function tool(){
        return $this->belongsTo(LeanTool::class);
    }
}

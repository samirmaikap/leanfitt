<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TangibleIntangible extends Model
{
    protected $fillable=[
        'project_id',
        'type',
        'value'
    ];

    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }
}

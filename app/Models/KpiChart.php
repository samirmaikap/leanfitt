<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiChart extends Model
{

    protected $fillable=[
        'project_id',
        'title',
        'x_label',
        'x_unit',
        'y_label',
        'y_unit',
        'target',
        'trend',
        'start_date',
        'end_date',
    ];

    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function data(){
        return $this->hasMany(KpiDataPoint::class);
    }
}

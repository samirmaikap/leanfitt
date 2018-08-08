<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable=[
        'title',
        'lean_tool_id',
        'project_id',
    ];

    public function category(){
        return $this->belongsTo(LeanTool::class,'lean_tool_id','id');
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function charts(){
        return $this->hasMany(ReportChart::class);
    }

    public function axis(){
        return $this->hasMany(ReportChartAxis::class);
    }

    public function defaultAssignments(){
        return $this->hasMany(ReportDefaultAssignment::class);
    }

    public function elementAssignment(){
        return $this->hasMany(ReportElementAssignment::class);
    }

    public function grid(){
        return $this->hasMany(ReportGrid::class);
    }

    public function problem(){
        return $this->hasMany(ReportProblem::class);
    }
}

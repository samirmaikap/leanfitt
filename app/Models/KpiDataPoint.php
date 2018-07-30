<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiDataPoint extends Model
{
    protected $fillable=[
        'kpi_chart_id',
        'x_value',
        'y_value',
        'date',
        'description',
    ];

    public function kpiChart(){
        return $this->belongsTo(KpiChart::class);
    }
}

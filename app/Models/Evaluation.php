<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable=[
        'organization_user_id',
        'communication',
        'enthusiasm',
        'participation',
        'quality_work',
        'dependability',
        'remark',
        'evaluated_by'
    ];

    public function user(){
        return $this->belongsTo(OrganizationUser::class,'organization_user_id','id');
    }

    public function evaluator(){
        return $this->belongsTo(User::class,'evaluated_by','id');
    }
}

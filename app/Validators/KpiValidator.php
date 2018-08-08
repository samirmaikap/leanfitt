<?php

namespace App\Validators;


class KpiValidator extends BaseValidator
{

    public  static $rules=[
        'create'=>[
            'project_id'=>'required',
            'title'=>'required',
            'x_label'=>'required',
            'y_label'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'target'=>'required|numeric',
            'trend'=>'required'
        ]
    ];
}
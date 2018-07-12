<?php

namespace App\Validators;

class ReportValidator extends BaseValidator
{
    public static $rules=[
        'create'=>[
            'report_category_id'=>'required',
            'project_id'=>'required',
            'created_by'=>'required'
        ]
    ];
}
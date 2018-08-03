<?php

namespace App\Validators;

class ReportValidator extends BaseValidator
{
    public static $rules=[
        'create'=>[
            'lean_tool_id'=>'required',
            'project_id'=>'required',
        ]
    ];
}
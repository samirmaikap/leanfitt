<?php

namespace App\Validators;


class DepartmentValidator extends BaseValidator
{
    public  static $rules=[
        'create'=>[
            'name'=>'required',
            'organization_id'=>'required',
//
        ],
        'update'=>[
            'name'=>'required'
        ]
    ];
}
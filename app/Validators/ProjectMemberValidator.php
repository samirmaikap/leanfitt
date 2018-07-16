<?php

namespace App\Validators;


class ProjectMemberValidator extends BaseValidator
{
    public static $rules=[
        'create'=>[
            'project_id'=>'required',
            'user_id'=>'required',
        ]
    ];
}
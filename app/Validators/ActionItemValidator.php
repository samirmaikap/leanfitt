<?php

namespace App\Validators;


class ActionItemValidator extends BaseValidator
{
    public static $rules=[
        'create'=>[
            'name'=>'required',
            'board_id'=>'required',
            'project_id'=>'required',
            'assignor_id'=>'required',
            'position'=>'required',
            'due_date'=>'required',

            'type'=>'required',
        ]
    ];
}
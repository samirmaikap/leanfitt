<?php

namespace App\Validators;


class ActionItemValidator extends BaseValidator
{
    public static $rules=[
        'create'=>[
            'title'=>'required',
//            'board_id'=>'required',
            'process_id'=>'required',
            'user_id'=>'required',
            'position'=>'numeric',
            'due_date'=>'date',
//            'type'=>'required',
        ]
    ];
}
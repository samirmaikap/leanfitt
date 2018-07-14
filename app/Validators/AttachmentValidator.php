<?php

namespace App\Validators;


class AttachmentValidator extends BaseValidator
{
    public static $rules=[
        'create'=>[
            'type'=>'required',
        ]
    ];
}
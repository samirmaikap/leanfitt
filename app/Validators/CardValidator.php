<?php

namespace App\Validators;


class CardValidator extends BaseValidator
{
    public static $rules=[
        'create'=>[
            'number'=>'required|numeric',
            'exp_month'=>'required|numeric',
            'exp_year'=>'required|numeric',
            'cvc'=>'required|numeric'
        ]
    ];
}
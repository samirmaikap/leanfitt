<?php
/**
 * Created by PhpStorm.
 * User: samir
 * Date: 7/14/2018
 * Time: 11:02 AM
 */

namespace App\Validators;


class CardValidator extends BaseValidator
{
    public static $rules=[
        'create'=>[
            'number'=>'required|min:16|max:16|numeric',
            'exp_month'=>'required|integer|min:2|max:2',
            'exp_year'=>'required|integer|min:2|max:2',
            'cvc'=>'required|integer|min:3|max:3'
        ]
    ];
}
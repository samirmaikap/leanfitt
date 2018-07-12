<?php

namespace App\Validators;


class OrganizationValidator extends BaseValidator
{
    public static $rules=[
        'create'=>[
            'name'=>'required',
            'subdomain'=>'required|unique:organizations',
        ]
    ];
}
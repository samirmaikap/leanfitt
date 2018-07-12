<?php

namespace App\Validators;

class UserValidator extends BaseValidator
{

    public static $rules = [
        "create" => [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:6',
        ],
        "update" => [
            'password' => 'confirmed|min:6',
        ],

    ];

}
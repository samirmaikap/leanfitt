<?php

namespace App\Validators;
use Illuminate\Support\Facades\Validator;

abstract class BaseValidator extends Validator{

    protected $data;
    public $messages;
    public static  $rules;
    protected $type;

    protected $validator;

    public function __construct($inputs,$type)
    {
        $this->data = $inputs;
        $this->type=$type;
    }

    public function fails()
    {
        $validation = Validator::make($this->data, static::$rules[$this->type]);

        if ($validation->fails())
        {
            $this->messages = $validation->messages();
            return true;
        }

        return false;
    }

    public function messages()
    {
        return $this->messages;
    }
}
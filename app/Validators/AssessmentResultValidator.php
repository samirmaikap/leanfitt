<?php

namespace App\Validators;


class AssessmentResultValidator extends BaseValidator
{
    public static $rules=[
      'create'=>[
          'employee_id',
          'assessments'
      ]
    ];
}
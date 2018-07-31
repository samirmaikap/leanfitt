<?php

namespace App\Repositories;


use App\Models\Evaluation;

class EvaluationRepository extends BaseRepository
{
    public function model()
    {
        return new Evaluation();
    }
}
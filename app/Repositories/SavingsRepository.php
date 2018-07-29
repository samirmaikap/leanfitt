<?php


namespace App\Repositories;


use App\Models\TangibleIntangible;

class SavingsRepository extends BaseRepository
{
    public function model()
    {
        return new TangibleIntangible();
    }
}
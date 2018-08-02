<?php


namespace App\Repositories;


use App\Models\TangibleIntangible;
use Illuminate\Support\Facades\DB;

class SavingsRepository extends BaseRepository
{
    public function model()
    {
        return new TangibleIntangible();
    }
}
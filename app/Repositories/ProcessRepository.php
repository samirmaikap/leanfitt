<?php

namespace App\Repositories;


use App\Models\ActionItem;
use App\Models\Process;

class ProcessRepository extends BaseRepository
{
    public function model()
    {
        return new Process();
    }

    public function getByBoard($boardId)
    {
        return $this->hasMany(ActionItem::class);
    }

}
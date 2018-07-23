<?php

namespace App\Repositories;

use App\Models\Board;
use App\Repositories\Contracts\BoardRepositoryInterface;

class BoardRepository extends BaseRepository implements BoardRepositoryInterface
{

    public function model()
    {
        return new Board();
    }

    public function getByProject($projectId)
    {
        return $this->where('project_id', $projectId)->get();
    }

    public function getByOrganization($organizationId)
    {
        return $this->whereHas('project.organization', function ($query) use($organizationId) {
            return $query->where('organization_id', '=', $organizationId);
        })->get();
    }

}
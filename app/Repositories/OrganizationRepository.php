<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Repositories\Contracts\OrganizationRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use function is_integer;

class OrganizationRepository extends  BaseRepository implements OrganizationRepositoryInterface
{
    public function model()
    {
        return new Organization();
    }

    public function findOrganizationBySubdomain($subdomain)
    {
        return $this->where("subdomain", $subdomain)->first();
    }

    public function getRoles($organization){
        $query=$this->model()
            ->join('organization_role as or','or.organization_id','=','organizations.id')
            ->where('organizations.id',empty($organization) ? '!=' : '=',empty($organization) ? null : $organization)
            ->select( DB::raw("count(or.id) AS roles_count"))
            ->first();

        return $query->roles_count;
    }
}
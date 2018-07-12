<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Repositories\Contracts\OrganizationRepositoryInterface;
use Illuminate\Support\Collection;
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

}
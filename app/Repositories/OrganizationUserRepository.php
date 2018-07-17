<?php

namespace App\Repositories;


use App\Models\OrganizationUser;

class OrganizationUserRepository extends BaseRepository
{
    public function model()
    {
        return new OrganizationUser();
    }
}
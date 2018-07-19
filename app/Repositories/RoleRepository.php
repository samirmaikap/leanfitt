<?php

namespace App\Repositories;


// use Spatie\Permission\Models\Role;
use App\Models\Role;

class RoleRepository extends BaseRepository
{
    public function model()
    {
        return new Role();
    }
}
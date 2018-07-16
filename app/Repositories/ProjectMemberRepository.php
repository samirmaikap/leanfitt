<?php
namespace App\Repositories;


use App\Models\ProjectMember;

class ProjectMemberRepository extends BaseRepository
{
    public function model()
    {
       return new ProjectMember();
    }
}
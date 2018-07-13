<?php

namespace App\Services;


use App\Repositories\AwardRepository;
use App\Services\Contracts\AwardServiceInterface;

class AwardService implements AwardServiceInterface
{
    protected $repo;
    public function __construct(AwardRepository $awardRepository)
    {
        $this->repo=$awardRepository;
    }

    public function index($data)
    {
        $department=arrayValue($data,'department');
        $organization=arrayValue($data,'organization');
        $user=arrayValue($data,'user');

        $query=$this->repo->getAwards($organization,$department,$user);
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        return renderCollection($query);
    }
}
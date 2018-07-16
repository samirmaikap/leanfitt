<?php

namespace App\Services;


use App\Repositories\ProjectActivityRepository;
use App\Repositories\ProjectMemberRepository;
use App\Validators\ProjectMemberValidator;

class ProjectMemberService
{
    protected $repo;
    protected $activityRepo;
    public function __construct(ProjectMemberRepository $memberRepository,
                                ProjectActivityRepository $projectActivityRepository)
    {
        $this->repo=$memberRepository;
        $this->activityRepo=$projectActivityRepository;
    }

    public function create($data){
        $validator=new ProjectMemberValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        $exists=$this->repo->where('project_id',arrayValue($data['project_id']))->where('user_id',arrayValue($data,'user_id'))->exists();
        if($exists){
            throw new \Exception('Member already exists');
        }

        $query=$this->repo->create($data);
        $log='New member '.isset($query->user()->name) ? $query->user()->name : 'n/a' .' added';
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        $this->activityRepo->create(['added_by'=>auth()->user()->id,'project_id'=>$data['project_id'],'log'=>$log]);
        return;
    }

    public function delete($project_id,$user_id){
        if(empty($project_id)){

        }
        $member=$this->repo->where('project_id',$project_id)->where('user_id',$user_id)->first();
        $log=isset($member->user()->name) ? $member->user()->name : 'A member'. ' has been removed';
        if(!$member){
            throw new \Exception('Member not found');
        }

        $query=$this->repo->deleteRecord($member);
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        $this->activityRepo->create(['added_by'=>auth()->user()->id,'project_id'=>$project_id,'log'=>$log]);
        return;
    }
}
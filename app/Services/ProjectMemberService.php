<?php

namespace App\Services;


use App\Events\ProjectMemberUpdated;
use App\Repositories\ProjectActivityRepository;
use App\Repositories\ProjectMemberRepository;
use App\Validators\ProjectMemberValidator;
use Illuminate\Support\Facades\Log;

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

        $exists=$this->repo->where('project_id',arrayValue($data,'project_id'))->where('user_id',arrayValue($data,'user_id'))->exists();
        if($exists){
            throw new \Exception('Member already exists');
        }

        $query=$this->repo->create($data);
        $log='New member added';
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        $this->activityRepo->create(['added_by'=>auth()->user()->id,'project_id'=>$data['project_id'],'log'=>$log]);
        return;
    }

    public function delete($project_id,$member_id){
        if(empty($member_id)){
            throw new \Exception('Member not found');
        }
        $member=$this->repo->where('id',$member_id)->with('project','user')->first();
        $log=isset($member->user()->name) ? $member->user()->name : 'A member'. ' has been removed';
        if(!$member){
            throw new \Exception('Member not found');
        }

        $query=$this->repo->deleteRecord($member);
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        $data['first_name']=$member->user->first_name;
        $data['project']=$member->project->name;
        $data['project_id']=$member->project->id;
        $data['type']='deleted';
        $data['email']=$member->user->email;
        event(new ProjectMemberUpdated($data));
        $this->activityRepo->create(['added_by'=>auth()->user()->id,'project_id'=>$project_id,'log'=>$log]);
        return;
    }

    public function allMembers($project_id){
        if(empty($project_id)){
            return;
        }

        $query=$this->repo->allMembers($project_id);
        return $query;
    }
}

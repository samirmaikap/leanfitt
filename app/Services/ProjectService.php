<?php

namespace App\Services;

use App\Repositories\DeleteRepository;
use App\Repositories\ProjectActivityRepository;
use App\Repositories\ProjectRepository;
//use App\Services\Contracts\ProjectServiceInterface;
use App\Validators\ProjectValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProjectService //implements ProjectServiceInterface
{

    protected $projectRepo;
    protected $activityRepo;
    protected $deleteRepo;
    public function __construct(ProjectRepository $projectRepository,
                                ProjectActivityRepository $projectActivityRepository,
                                DeleteRepository $deleteRepository)
    {
        $this->projectRepo=$projectRepository;
        $this->activityRepo=$projectActivityRepository;
        $this->deleteRepo=$deleteRepository;
    }

    public function index($data)
    {
        $organization=arrayValue($data,'organization');

        $query=$this->projectRepo->allProject($organization);
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        return $query;
    }


    public function show($project_id)
    {
        if(empty($project_id)){
            throw new \Exception("Project id field is required");
        }

        $query=$this->projectRepo->getProject($project_id);
        if($query){
            $data['id']=$query['id'];
            $data['name']=$query['name'];
            $data['start_date']=$query['start_date'];
            $data['end_date']=$query['end_date'];
            $data['report_date']=$query['report_date'];
            $data['is_completed']=$query['is_completed'];
            $data['is_archived']=$query['is_archived'];
            $data['action_items']=count($query['actionItem']) > 0 ? $query['actionItem']->map(function($item){
                return collect($item)->except('assignees');
            }) : null ;
            $data['members']=count($query['member']) > 0 ? $query['member']->map(function($ac){
                return [
                    'id'=>$ac['user']['id'],
                    'first_name'=>$ac['user']['first_name'],
                    'last_name'=>$ac['user']['last_name'],
                    'avatar'=>$ac['user']['avatar'],
                ];
            }) : null ;
            $data['comments']=isset($query['comments']) ? $query['comments']->map(function($comment){
                return [
                    'id'=>$comment['id'],
                    'commenter_id'=>isset($comment['user']['id']) ? $comment['user']['id'] : null,
                    'commenter_name'=>isset($comment['user']['id']) ? $comment['user']['first_name'].' '.$comment['user']['last_name'] : null,
                    'commenter_avatar'=>isset($comment['user']['id']) ? $comment['user']['avatar'] : null,
                    'comment'=>$comment['comment'],
                    'created_at'=>Carbon::parse($comment['created_at'])->format('Y-m-d H:i:s')
                ];
            }) :null;
            $data['attachments']=isset($query['attachments']) ? $query['attachments']->map(function($atta){
                return collect($atta)->except('path');
            }) :null;
            $data['activities']=isset($query['activity']) ? $query['activity']->map(function ($activity){
                  return ['id'=>$activity['id'],
                      'user_id'=>isset($activity['user']['id']) ? $activity['user']['id'] : null,
                      'user_name'=>isset($activity['user']['id']) ? $activity['user']['first_name'].' '.$activity['user']['last_name'] : null,
                      'user_avatar'=>isset($activity['user']['id']) ? $activity['user']['avatar'] : null,
                      'log'=>$activity['log'],
                      'created_at'=>Carbon::parse($activity['created_at'])->format('Y-m-d H:i:s')
                  ];
            }) :null;


            return renderCollection($data);
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }
    }

    public function create($data)
    {
        $validator=new ProjectValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        $query=$this->projectRepo->create($data);
        if($query){
            $this->activityRepo->create(['added_by'=>auth()->user()->id,'project_id'=>$query->id,'log'=>'Project created']);
            return;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }
    }

    public function update($data, $project_id)
    {
        if(empty($project_id)){
            throw new \Exception("Project id field is required");
        }

        $query=$this->projectRepo->update($project_id,$data);
        if($query){
            $this->activityRepo->create(['added_by'=>auth()->user()->id,'project_id'=>$project_id,'log'=>'Project updated']);
            return;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }
    }

    public function archive($project_id)
    {
        if(empty($project_id)){
            throw new \Exception("Project id field is required");
        }

        $query=$this->projectRepo->archive($project_id);
        if($query){
            $this->activityRepo->create(['added_by'=>auth()->user()->id,'project_id'=>$project_id,'log'=>'Project archived']);
            return;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }
    }

    public function restore($project_id)
    {
        if(empty($project_id)){
            throw new \Exception("Please select a project");
        }

        $query=$this->projectRepo->restore($project_id);
        if($query){
            $this->activityRepo->create(['added_by'=>auth()->user()->id,'project_id'=>$project_id,'log'=>'Project restored']);
            return;
        }
        else{
            throw new \Exception(common('messages.config_error'));
        }
    }

    public function complete($project_id)
    {
        if(empty($project_id)){
            throw new \Exception("Please select a project");
        }

        $project=$this->projectRepo->find($project_id);
        if($project){
            if($project->is_archived==1){
                throw new \Exception("Can't complete a project which is archived");
            }

            $update=$this->projectRepo->fillUpdate($project,['is_completed'=>1]);
            if($update){
                $this->activityRepo->create(['added_by'=>auth()->user()->id,'project_id'=>$project_id,'log'=>'Project completed']);
                return;
            }
            else{
                throw new \Exception(config('messages.common_error'));
            }

        }
        else{
            throw new \Exception("Project not found");
        }
    }

    public function delete($project_id)
    {
        if(empty($project_id)){
            throw new \Exception("project_id is required");
        }

        DB::beginTransaction();
        $project=$this->projectRepo->find($project_id);
        if(count($project) > 0){
            $deleteActionitem=$this->deleteRepo->deleteActionItems('project',$project->id);
            if($deleteActionitem){
                $self_delete=$this->projectRepo->deleteRecord($project);
                if($self_delete){
                    DB::commit();
                    return;
                }
                else{
                    DB::rollBack();
                    throw new \Exception(config('messages.common_error'));
                }
            }
            else{
                DB::rollBack();
                throw new \Exception(config('messages.common_error'));
            }
        }
        else{
            throw new \Exception("Project not found");
        }
    }
}
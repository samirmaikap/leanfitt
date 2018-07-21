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

    public function index($organization=null)
    {
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
            return $query;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }
    }

    public function create($data)
    {
        $data['organization_id']=pluckSession('id');
        $validator=new ProjectValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }
        $data['start_date']=Carbon::parse($data['start_date'])->format('Y-m-d');
        $data['end_date']=Carbon::parse($data['end_date'])->format('Y-m-d');
        $data['report_date']=Carbon::parse($data['report_date'])->format('Y-m-d');

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

    public function getMembers($project_id=null){
        if(empty($project_id)){
            return;
        }

        $query=$this->projectRepo->getMembers($project_id);
        return $query;
    }
}
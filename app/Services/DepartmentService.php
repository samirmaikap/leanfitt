<?php

namespace App\Services;


use App\Repositories\DepartmentRepository;
//use App\Services\Contracts\DepartmentServiceInterface;
use App\Validators\DepartmentValidator;
use function dd;

class DepartmentService //implements DepartmentServiceInterface
{
    protected $departmentRepo;
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepo=$departmentRepository;
    }

    public function allDepartments()
    {
        return $this->departmentRepo->withCount(['users'])->get();
    }

    public function list($data){
        $organization=arrayValue($data,'organization');

        $query=$this->departmentRepo->getDepartments($organization);
        if(!$query)
            throw new \Exception(config('messages.common_error'));
        return renderCollection($query);
    }

    public function details($departmentId)
    {
        if(empty($departmentId)){
           throw new \Exception('Department id field is required');
        }

        $query=$this->departmentRepo->where('id',$departmentId)->with('organization')->first();
        if($query){
            return $query;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function createDepartment($data)
    {
        $validator=new DepartmentValidator($data, 'create');
        
        if($validator->fails())
        {
            throw new \Exception($validator->messages()->first());
        }

        $query=$this->departmentRepo->create($data);
        if($query){
            return;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }
    }

    public function updateDepartment($data, $id)
    {
        $validator=new DepartmentValidator($data, 'update');

        if($validator->fails())
        {
            throw new \Exception($validator->messages()->first());
        }

        $query=$this->departmentRepo->update($id, $data);
        if($query){
            return;
        }
        else{
            throw new \Exception(confif('messages.common_error'));
        }
    }

    public function removeDepartment($departmentId)
    {
        if(empty($departmentId))
        {
            throw new \Exception("Department id field is required");
        }

        $department = $this->departmentRepo->find($departmentId);
        $department->users()->detach();

        $query=$this->departmentRepo->delete($departmentId);
        if($query){
            return ;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }
    }
}
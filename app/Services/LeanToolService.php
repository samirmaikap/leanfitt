<?php

namespace App\Services;


use App\Repositories\LeantoolRepository;
use App\Validators\LeanToolValidator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class LeanToolService
{
    protected $toolRepo;
    public function __construct(LeantoolRepository $leantoolRepository)
    {
        $this->toolRepo=$leantoolRepository;
    }

    public function index()
    {
        $query=$this->toolRepo->all();
        $query=$query->map(function($item){
           return [
               'id'=>$item['id'],
               'name'=>$item['name'],
               'description'=>$item['description'],
               'quiz_count'=>count(json_decode($item['quiz'])),
           ];
        });

        if(!$query){
            throw new \Exception("No tools found");
        }

        return renderCollection($query);
    }

    public function create($data)
    {
        $validator=new LeanToolValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        DB::beginTransaction();
        $query=$this->toolRepo->create($data);
        if(!$query){
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

        DB::commit();
        return;
    }

    public function update($data, $tool_id)
    {
        if(empty($tool_id)){
            throw new \Exception("Tool id field is required");
        }

        DB::beginTransaction();
        $query=$this->toolRepo->update($tool_id,$data);
        if(!$query){
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

        DB::commit();
        return;
    }

    public function show($tool_id)
    {
        if(empty($tool_id)){
            throw new \Exception("Tool id field is required");
        }

        $query=$this->toolRepo->find($tool_id);
        if(!$query){
            throw new \Exception("Tool not found");
        }

        return $query;
    }

    public function delete($tool_id)
    {

        if(empty($tool_id)){
            throw new \Exception("Tool id field is required");
        }

        DB::beginTransaction();
        $tool=$this->toolRepo->find($tool_id);
        if(count($tool)){
            if($this->toolRepo->deleteRecord($tool)){
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
            throw new \Exception("Lean tool not found");
        }
    }
}
<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\BaseRepositoryInterface;

abstract class BaseRepository //implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract public function model();

    public function all($cols=null)
    {
        return $this->model->get($cols);
    }

    public function __construct()
    {
        $model = $this->model();

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
    }

    public function get()
    {
        return $this->model->get();
    }

    public function first($cols=null)
    {
        return $this->model->first($cols);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function where($col, $value, $operator='=')
    {
        $this->model=$this->model->where($col,$operator,$value);
        return $this->model;
    }

    public function orWhere($col, $value)
    {
        $this->model=$this->model->orWhere($col,$value);
        return $this->model;
    }

    public function whereIn($col, $values)
    {
        $this->model=$this->model->orWhere($col,$values);
        return $this->model;
    }

    public function whereBetween($col, $value1, $value2)
    {
        $this->model=$this->model->orWhere($col,[$value1,$value2]);
        return $this->model;
    }

    public function whereNotNull($col)
    {
        $this->model=$this->model->whereNotNull($col);
        return $this->model;
    }

    public function whereHas($relation, $closure)
    {
        $this->model = $this->model->whereHas($relation, $closure);
        return $this->model;
    }

    public function with($relation)
    {
        $this->model=$this->model->with($relation);
        return $this->model;
    }

    public function withCount($relation)
    {
        $this->model = $this->model->withCount($relation);
        return $this->model;
    }

    public function withTrashed()
    {
        $this->model=$this->model->withTrashed();
        return $this->model;
    }

    public function exists()
    {
        return $this->model->exists();
    }

    public function count(){
        return $this->model->count();
    }

    public function save($attributes)
    {
        return $this->model->save($attributes);
    }

    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    public function updateOrCreate($attributes){

        return $this->model->updateOrCreate($attributes);

    }

    public function firstOrCreate($attributes){

        return $this->model->firstOrCreate($attributes);

    }

    public function update($id,$attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    public function archive($id)
    {
        $query=$this->model->find($id);
        $query->is_archived=1;
        return $query->update();

    }

    public function restore($id)
    {
        $query=$this->model->find($id);
        $query->is_archived=0;
        return $query->update();
    }

    public function delete($id)
    {
       return $this->model->find($id)->delete();
    }

    public function forceDelete($id)
    {
        return $this->model->find($id)->forceDelete();
    }

    public function fillUpdate($record,$data){
        return $record->update($data);
    }

    public function deleteRecord($record){
        return $record->delete();
    }

    public function forceDeleteRecord($record)
    {
        return $record->forceDelete();
    }

    public function select($attributes)
    {
        $this->model = $this->model->select($attributes);
        return $this->model;
    }

    public function sum($col)
    {
        return $this->model->sum($col);
    }

    public function join($table,$clause1,$operator,$clause2)
    {
        $this->model = $this->model->join($table,$clause1,$operator,$clause2);
        return $this->model;
    }
}
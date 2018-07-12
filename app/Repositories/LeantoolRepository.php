<?php

namespace App\Repositories;

use App\Models\ActionItem;
use App\Models\LeanTool;
use App\Repositories\Contracts\LeanToolsRepositoryInterface;
use Illuminate\Support\Collection;

class LeantoolRepository extends BaseRepository implements LeanToolsRepositoryInterface
{

    public function model()
    {
        return new LeanTool();
    }

    public function allQuiz($user_id)
    {
        $query=$this->model()->with(['quizResult'=>function($query) use($user_id){
            $query->where('user_id',$user_id)->first();
        }])->get();

        return $query;
    }

    public function getQuiz($tool_id,$user_id)
    {
        $query=$this->model()->with(['quizResult'=>function($query) use($user_id){
            $query->where('user_id',$user_id)->first();
        }])->where('id',$tool_id)->first();

        return $query;
    }

    public function allAssessment($user_id)
    {
        $query=$this->model()->with(['assessmentResult'=>function($query) use($user_id){
            $query->where('user_id',$user_id)->orderBy('created_at');
        }])->get(['assessment','name','id','featured_image']);

        return $query;
    }

    public function getAssessment($tool_id,$employee_id){
        $query=$this->model()->where('id',$tool_id)->first(['id','name','assessment','featured_image']);
        return $query;
    }

    public function toolAssessment()
    {
        return $this->model()->all(['name','assessment']);
    }
}
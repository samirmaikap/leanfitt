<?php

namespace App\Services;

use App\Repositories\AwardRepository;
use App\Repositories\LeantoolRepository;
use App\Repositories\QuizRepository;
use App\Repositories\QuizResultRepository;
use App\Validators\QuizValidator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class QuizService
{
    protected $quizRepo;
    protected $toolRepo;
    protected $awardRepo;
    public function __construct(QuizRepository $quizRepository,
                                LeantoolRepository $leantoolRepository,
                                AwardRepository $awardRepository)
    {
        $this->quizRepo=$quizRepository;
        $this->toolRepo=$leantoolRepository;
        $this->awardRepo=$awardRepository;
    }

    public function index()
    {
        $user_id=auth()->user()->id;
        if(empty($user_id)){
            throw new \Exception("User id  field is required");
        }

        $query=$this->toolRepo->allQuiz($user_id);
        $query=$query->map(function($item){
            if(isset($item['quizResult'][0]['id'])){
                $quiz_taken=true;
                $score=$item['quizResult'][0]['score'];
            }
            else{
                $quiz_taken=false;
                $score=0;
            }

            return [
                'tool_id'=>$item['id'],
                'too_name'=>$item['name'],
                'question_count'=>count(json_decode($item['quiz'])),
                'quiz_taken'=>$quiz_taken,
                'score'=>$score
            ];
        });

        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        return renderCollection($query);
    }

    public function show($tool_id)
    {
        $user_id=auth()->user()->id;
        if(empty($user_id)){
            throw new \Exception("User id field is required");
        }

        if(empty($tool_id)){
            throw new \Exception("Tool id field is required");
        }

        $query=$this->toolRepo->getQuiz($tool_id,$user_id);
        if($query->count() > 0){
            $quiz=json_decode($query->quiz);
            $data['tool_id']=$query->id;
            $data['tool_name']=$query->name;
            $data['quiz']=$quiz;
            $data['question_count']=count($quiz);
            $data['taken']=count($query->quizResult) > 0 ? true : false;

            return renderCollection($data);
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function taken($data)
    {
        $organization=arrayValue($data,'organization');
        $department=arrayValue($data,'department');
        $user=arrayValue($data,'user');

        $query=$this->quizRepo->allTaken($organization,$department,$user);

        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        return renderCollection($query);

    }

    public function create($data)
    {

        $validator=new QuizValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        DB::beginTransaction();

        $data['score']=(arrayValue($data,'correct')/(arrayValue($data,'correct')+arrayValue($data,'incorrect')))*100;
        $query=$this->quizRepo->create($data);
        if($query){
            if(arrayValue($data,'incorrect')==0){
                $data['title']='Award for quiz';
                $data['type']='quiz';
                $this->awardRepo->create($data);

                DB::commit();
                return;
            }
            else{
                DB::commit();
                return;
            }
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

    }

}
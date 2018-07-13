<?php

namespace App\Services;


use App\Repositories\AssessmentRepository;
use App\Repositories\LeantoolRepository;
use App\Validators\AssessmentResultValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class AssessmentService
{
    protected $repo;
    protected $toolRepo;
    public function __construct(AssessmentRepository $assessmentRepository,
                                LeantoolRepository $leantoolRepository)
    {
        $this->repo=$assessmentRepository;
        $this->toolRepo=$leantoolRepository;
    }

    public function index($data)
    {
        $organization=arrayValue($data,'organization');
        $department=arrayValue($data,'department');
        $user=arrayValue($data,'user');

        $query=$this->repo->allAssessment($organization,$department,$user);

        if(!$query){
            throw new \Exception("No assessment result found");
        }

        return renderCollection($data);

    }

    public function show()
    {
        $tools=$this->toolRepo->toolAssessment();
        $collection=new Collection();
        foreach($tools as $num=>$tool){
            $assessments = json_decode($tool->assessment);
            shuffle($assessments);
            if(!is_array($assessments)){
                break;
            }
            $assessments=array_slice($assessments, 0, 3);
            foreach ($assessments as $assess){
                $data['tool_name']=$tool->name;
                $data['assessment']=$assess;
                $collection->push(new Collection($data));
            }
        }

        if(count($collection) > 0){
            return renderCollection($collection->shuffle());
        }
        else{
            throw new \Exception("No assessment found");
        }
    }

    public function create($data)
    {
        $validator=new AssessmentResultValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        $totalAvg = 0;
        $scores = [];
        foreach ($data['assessments'] as $tool => $answers) {
            $score = 0;
            foreach ($answers as $answer) {
                $score += intval($answer);
            }
            $totalAvg += $avg = $score / count($answers);
            $scores[$tool] = (float)number_format((float)$avg, 2, '.', '');
        }
        arsort($scores);
        $totalAvg = $totalAvg / count($data['assessments']);
        $scores['Average'] = (float)number_format((float)($totalAvg), 2, '.', '');

        $assessments = [
            'user_id' => $data['user_id'],
            'result' => $scores
        ];


        $query=$this->repo->create($assessments);
        if($query){
            return;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }

    }
}
<?php

namespace App\Services;


use App\Repositories\ReportCategoryRepository;
use App\Repositories\ReportChartAxesRepository;
use App\Repositories\ReportChartRepository;
use App\Repositories\ReportDefaultAssignmentRepository;
use App\Repositories\ReportDefaultRepository;
use App\Repositories\ReportElementAssignemtnRepository;
use App\Repositories\ReportElementRepository;
use App\Repositories\ReportGridRepository;
use App\Repositories\ReportProblemRepository;
use App\Repositories\ReportReasonRepository;
use App\Repositories\ReportRepository;
//use App\Services\Contracts\ReportServiceInterface;
use App\Validators\ReportAssignmentValidator;
use App\Validators\ReportChartValidator;
use App\Validators\ReportDefaultValidator;
use App\Validators\ReportElementAssignmentValidator;
use App\Validators\ReportElementValidator;
use App\Validators\ReportGridValidator;
use App\Validators\ReportValidator;
use Illuminate\Support\Facades\DB;

class ReportService //implements ReportServiceInterface
{
    protected $reportRepo;
    protected $categoryRepo;
    protected $chartRepo;
    protected $chartAxisRepo;
    protected $gridRepo;
    protected $defaultRepo;
    protected $defaultAssignmentRepo;
    protected $elementRepo;
    protected $elementAssignmentRepo;
    protected $problemRepo;
    protected $reasonRepo;
    public function __construct(ReportRepository $reportRepository,
                                ReportCategoryRepository $categoryRepository,
                                ReportChartRepository $reportChartRepository,
                                ReportChartAxesRepository $chartAxesRepository,
                                ReportGridRepository $gridRepository,
                                ReportDefaultRepository $defaultRepository,
                                ReportDefaultAssignmentRepository $assignmentRepository,
                                ReportElementRepository $elementRepository,
                                ReportElementAssignemtnRepository $elementAssignemtnRepository,
                                ReportProblemRepository $problemRepository,
                                ReportReasonRepository $reasonRepository)
    {
        $this->reportRepo=$reportRepository;
        $this->categoryRepo=$categoryRepository;
        $this->chartRepo=$reportChartRepository;
        $this->chartAxisRepo=$chartAxesRepository;
        $this->gridRepo=$gridRepository;
        $this->defaultRepo=$defaultRepository;
        $this->defaultAssignmentRepo=$assignmentRepository;
        $this->elementRepo=$elementRepository;
        $this->elementAssignmentRepo=$elementAssignemtnRepository;
        $this->problemRepo=$problemRepository;
        $this->reasonRepo=$reasonRepository;
    }

    public function index($project_id)
    {
        if(empty($project_id)){
            throw new \Exception("No report found");
        }

        $query=$this->reportRepo->allReports($project_id);

        if(!$query){
            throw new \Exception("No report found");
        }

        return $query;

    }

    public function names()
    {
        $query=$this->categoryRepo->all();
        if(count($query) > 0){
            return $query;
        }
        else{
            throw new \Exception("No category found");
        }

    }

    public function create($data)
    {
        $validator=new ReportValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        DB::beginTransaction();
        $query=$this->reportRepo->create($data);
        if($query){
            DB::commit();
            return $query;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function show($report_id)
    {

        if(empty($report_id)){
            throw new \Exception("Report id field is required");
        }

        $query=$this->reportRepo->showReport($report_id);
        if(count($query) > 0){
            return $query;
        }
        else{
            throw new \Exception("No report found");
        }
    }

    public function delete($report_id)
    {
        if(empty($report_id)){
            throw new \Exception("Report id field is required");
        }

        DB::beginTransaction();
        $report=$this->reportRepo->find($report_id);
        if($report){
            $delete=$this->reportRepo->deleteRecord($report);
            if($delete){
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
            throw new \Exception("Report not found");
        }
    }

    public function showGridData($report_id)
    {
        if(empty($report_id)){
            throw new \Exception("Report id field is required");
        }

        $query=$this->gridRepo->allGrids($report_id);
        if(count($query) > 0){
            return $query->groupBy('position');
        }
        else{
            throw new \Exception("No data found");
        }

    }

    public function createGridData($data)
    {
        $validator=new ReportGridValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        DB::beginTransaction();
        $query=$this->gridRepo->create($data);
        if($query){
            DB::commit();
            return;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function deleteGridData($grid_id)
    {
        if(empty($grid_id)){
            throw new \Exception("Grid id field is required");
        }

        DB::beginTransaction();
        $grid=$this->gridRepo->find($grid_id);
        if($grid){
             $query=$this->gridRepo->deleteRecord($grid);
             if($query){
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
            throw new \Exception("Requested data not found");
        }
    }

    public function showChartData($report_id)
    {
        if(empty($report_id)){
            throw new \Exception("Report id field is required");
        }

        $query=$this->chartAxisRepo->getChart($report_id);

        if(count($query) > 0){
            return $query;
        }
        else{
            throw new \Exception("No data found");
        }
    }

    public function createChartData($data)
    {
        $validator=new ReportChartValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        $query=$this->chartRepo->create($data);
        if($query){
            $chartaxes=$this->chartAxisRepo->create(['x'=>'x axis','y'=>'y axis','report_id'=>$data['report_id']]);
            if($chartaxes){
                return;
            }
            else{
                throw new \Exception(config('messages.common_error'));
            }
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }
    }

    public function deleteChartData($chart_id)
    {
        if(empty($chart_id)){
            throw new \Exception("chart_id is required");
        }

        DB::beginTransaction();
        $chart=$this->chartRepo->find($chart_id);
        if(count($chart)){
            $query=$this->chartRepo->forceDeleteRecord($chart);
            if($query){
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
            throw new \Exception("Chart data not found");
        }

    }

    public function changeChartAxis($data)
    {
        if(empty($data)){
            throw new \Exception("Can't add the empty data");
        }

        if(empty(arrayValue($data,'report_id'))){
            throw new \Exception("report_id is required");
        }

        DB::beginTransaction();
        $chart=$this->chartAxisRepo->where('report_id',arrayValue($data,'report_id'))->first();
        if(count($chart) > 0){
            $update=$this->chartAxisRepo->fillUpdate($chart,$data);
            if($update){
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
            throw new \Exception("Chart not found");
        }
    }

    public function showDefaultData($data, $report_id,$level)
    {
        if(empty($report_id)){
            throw new \Exception("Report id field is required");
        }

        $level=empty($level) ? 1 : $level;
        $type=arrayValue($data,'type');
        $category_id=$this->reportRepo->getCategory($report_id);

        $query=$this->defaultRepo->getDefault($report_id,$level);

        if(!empty($type)){
            $query=$query->where('type',$type);
        }

        if(!empty($category_id)){
            $query=$query->where('report_category_id',$category_id);
        }

        $query=$query->get();
        if(count($query) > 0){
            return $query;
        }
        else{
            throw new \Exception("No data found");
        }
    }

    public function showDefaultElementData($data, $default_id,$report_id)
    {
        if(empty($default_id)){
            throw new \Exception("Default id field is required");
        }
        $sort=arrayValue($data,'sort');

        $query=$this->elementRepo->getElements($default_id,$report_id);
        if(!empty($sort)){
            $query=$query->where('sort',$sort);
        }

        $query=$query->get();
        if(count($query) > 0){
            return $query;
        }
        else{
            throw new \Exception("No data found");
        }
    }

    public function createDefaultData($data)
    {

        if(empty(arrayValue($data,'report_category_id')) && empty(arrayValue($data,'report_id'))){
            throw new \Exception("Report id field is required");
        }

        if(empty(arrayValue($data,'report_category_id'))){
            $data['report_category_id']=$this->reportRepo->getCategory($data['report_id']);
        }else{
            $data['report_category_id']=$data['report_category_id'];
        }

        $validator=new ReportDefaultValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        DB::beginTransaction();
        $query=$this->defaultRepo->create($data);
        if($query){
            DB::commit();
            return;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function createDefaultElementData($data)
    {
        $validator=new ReportElementValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        DB::beginTransaction();
        $query=$this->elementRepo->create($data);
        if($query){
            DB::commit();
            return;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function deleteDefaultData($default_id)
    {
        if(empty($default_id)){
            throw new \Exception("Default id field is required");
        }

        DB::beginTransaction();
        $default=$this->defaultRepo->find($default_id);
        if($default){
            $query=$this->defaultRepo->deleteRecord($default);
            if($query){
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
            throw new \Exception("Data not found");
        }
    }

    public function deleteDefaultElementData($element_id)
    {
        if(empty($element_id)){
            throw new \Exception("Element id field is required");
        }

        DB::beginTransaction();
        $default=$this->elementRepo->find($element_id);
        if($default){
            $query=$this->elementRepo->deleteRecord($default);
            if($query){
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
            throw new \Exception("Data not found");
        }

    }

    public function showDefaultAssignments($report_id, $level)
    {
        if(empty($report_id)){
            throw new \Exception("Report id field is required");
        }

        $level=empty($level) ? 1 : $level;
        $query=$this->defaultAssignmentRepo->getAssignments($report_id,$level);
        if($query){
            return $query;
        }
        else{
            throw new \Exception("No data found");
        }
    }

    public function showElementAssignments($default_id, $level)
    {
        if(empty($default_id)){
            throw new \Exception("Default id field is required");
        }

        $level=empty($level) ? 1 :$level;
        $query=$this->elementAssignmentRepo->getAssignments($default_id,$level);
        if($query){
            return $query;
        }
        else{
            throw new \Exception("No data found");
        }

    }

    public function createDefaultAssignments($data)
    {
        $validator=new ReportAssignmentValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        DB::beginTransaction();
        $query=$this->defaultAssignmentRepo->create($data);
        if($query){
            DB::commit();
            return;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }
    }

    public function createElementAssignments($data)
    {
        $validator=new ReportElementAssignmentValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        DB::beginTransaction();
        $query=$this->elementAssignmentRepo->create($data);
        if($query){
            DB::commit();
            return;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function deleteDefaultAssignments($default_id)
    {
        if(empty($default_id)){
            throw new \Exception("Default id field is required");
        }

        DB::beginTransaction();
        $default=$this->defaultAssignmentRepo->find($default_id);
        if($default){
            $query=$this->defaultAssignmentRepo->deleteRecord($default);
            if($query){
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
            throw new \Exception("Data not found");
        }

    }

    public function deleteElementAssignments($assignment_id)
    {
        if(empty($assignment_id)){
            throw new \Exception("Assignment id field is required");
        }

        DB::beginTransaction();
        $default=$this->elementAssignmentRepo->find($assignment_id);
        if(count($default) > 0){
            $query=$this->elementAssignmentRepo->forceDeleteRecord($default);
            if($query){
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
            throw new \Exception("Data not found");
        }

    }

    public function showFive($report_id)
    {
        if(empty($report_id)){
            throw new \Exception("Report id field is required");
        }
        $query=$this->problemRepo->getProblems($report_id);
        if(count($query) > 0){
            return $query;
        }
        else{
            throw new \Exception("No data found");
        }
    }

    public function createFive($data)
    {
        if(empty($data)){
            throw new \Exception("Can't add the empty data");
        }

        DB::beginTransaction();
        $query=$this->problemRepo->create($data);
        if($query){
            DB::commit();
            return;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }
    }

    public function createFiveWhy($data)
    {
        
        if(empty($data)){
            throw new \Exception("Can't add the empty data");
        }

        DB::beginTransaction();
        $query=$this->reasonRepo->create($data);
        if($query){
            DB::commit();
            return;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function deleteFive($problem_id)
    {
        if(empty($problem_id)){
            throw new \Exception("Problem id field is required");
        }

        DB::beginTransaction();
        $default=$this->problemRepo->find($problem_id);
        if(count($default) > 0){
            $query=$this->problemRepo->forceDeleteRecord($default);
            if($query){
                DB::commit();
                return;
            }
            else{
                DB::rollBack();
                throw new \Exception(config('messages.common_error'));
            }
        }
        else{
            throw new \Exception("Data not found");
        }

    }

    public function deleteFiveWhy($reason_id)
    {
        if(empty($reason_id)){
            throw new \Exception("Reason field is required");
        }

        DB::beginTransaction();
        $default=$this->reasonRepo->find($reason_id);
        if(count($default) > 0){
            $query=$this->reasonRepo->forceDeleteRecord($default);
            if($query){
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
            throw new \Exception("Data not found");
        }
    }
}
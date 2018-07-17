<?php

namespace App\Http\Controllers\API;

use App\Services\ReportService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    protected $service;
    public function __construct(ReportService $reportService)
    {
        $this->service=$reportService;
    }

    public function index(Request $request){
        try{
            $result=$this->service->index($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function names(){
        try{
            $result=$this->service->names();
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function create(Request $request){
        try{
            $result=$this->service->create($request->all());
            return renderSuccess($result,'Report has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function show($report_id){
        try{
            $result=$this->service->show($report_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function delete($report_id){
        try{
            $result=$this->service->delete($report_id);
            return renderSuccess($result,'Report hass been deleted',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function showGridData($report_id){
        try{
            $result=$this->service->showGridData($report_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function createGridData(Request $request){
        try{
            $result=$this->service->createGridData($request->all());
            return renderSuccess($result,'Data has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function deleteGridData($grid_id){
        try{
            $result=$this->service->deleteGridData($grid_id);
            return renderSuccess($result,'Data has been deleted',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function showChartData($report_id){
        try{
            $result=$this->service->showChartData($report_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function createChartData(Request $request){
        try{
            $result=$this->service->createChartData($request->all());
            return renderSuccess($result,'Data has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function deleteChartData($chart_id){
        try{
            $result=$this->service->deleteChartData($chart_id);
            return renderSuccess($result,'Data has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function changeChartAxis(Request $request,$report_id){
        try{
            $result=$this->service->changeChartAxis($request->all(),$report_id);
            return renderSuccess($result,'Chart axis name has been changed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function showDefaultData(Request $request,$report_id,$level){
        try{
            $result=$this->service->showDefaultData($request->all(),$report_id,$level);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function showDefaultElementData(Request $request,$default_id,$report_id){
        try{
            $result=$this->service->showDefaultElementData($request->all(),$default_id,$report_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function createDefaultData(Request $request){
        try{
            $result=$this->service->createDefaultData($request->all());
            return renderSuccess($result,'Data has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function createDefaultElementData(Request $request){
        try{
            $result=$this->service->createDefaultElementData($request->all());
            return renderSuccess($result,'Data has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function deleteDefaultData($default_id){
        try{
            $result=$this->service->deleteDefaultData($default_id);
            return renderSuccess($result,'Data has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function deleteDefaultElementData($element_id){
        try{
            $result=$this->service->deleteDefaultElementData($element_id);
            return renderSuccess($result,'Data has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function showDefaultAssignments($report_id,$level){
        try{
            $result=$this->service->showDefaultAssignments($report_id,$level);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function showElementAssignments($default_id,$level){
        try{
            $result=$this->service->showElementAssignments($default_id,$level);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function createDefaultAssignments(Request $request){
        try{
            $result=$this->service->createDefaultAssignments($request->all());
            return renderSuccess($result,'Data has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function createElementAssignments(Request $request){
        try{
            $result=$this->service->createElementAssignments($request->all());
            return renderSuccess($result,'Data has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function deleteDefaultAssignments($default_id){
        try{
            $result=$this->service->deleteDefaultAssignments($default_id);
            return renderSuccess($result,'Data has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function deleteElementAssignments($assignment_id){
        try{
            $result=$this->service->deleteElementAssignments($assignment_id);
            return renderSuccess($result,'Data has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function showFive($report_id){
        try{
            $result=$this->service->showFive($report_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function createFive(Request $request){
        try{
            $result=$this->service->createFive($request->all());
            return renderSuccess($result,'Data has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function createFiveWhy(Request $request){
        try{
            $result=$this->service->createFiveWhy($request->all());
            return renderSuccess($result,'Data has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function deleteFive($problem_id){
        try{
            $result=$this->service->deleteFive($problem_id);
            return renderSuccess($result,'Data has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function deleteFiveWhy($reason_id){
        try{
            $result=$this->service->deleteFiveWhy($reason_id);
            return renderSuccess($result,'Data has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}

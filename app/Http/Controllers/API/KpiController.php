<?php

namespace App\Http\Controllers\API;

use App\Services\KpiService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KpiController extends Controller
{
    protected $service;
    public function __construct(KpiService $kpiService)
    {
        $this->service=$kpiService;
    }

    public function index(Request $request){
        try{
            $result=$this->service->index($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function show($kpi_id){
        try{
            $result=$this->service->show($kpi_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function create(Request $request){
        try{
            $result=$this->service->create($request->all());
            return renderSuccess($result,'Kpi has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function update(Request $request,$kpi_id){
        try{
            $result=$this->service->update($request->all(),$kpi_id);
            return renderSuccess($result,'Kpi has been updated',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function delete($kpi_id){
        try{
            $result=$this->service->delete($kpi_id);
            return renderSuccess($result,'Kpi has been deleted',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function addDataPoint(Request $request){
        try{
            $result=$this->service->addDataPoint($request->all());
            return renderSuccess($result,'Data point has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function filterDataPoint(Request $request){
        try{
            $result=$this->service->filterDataPoint($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function deleteDataPoint($point_id){
        try{
            $result=$this->service->deleteDatapoint($point_id);
            return renderSuccess($result,'Data point has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}

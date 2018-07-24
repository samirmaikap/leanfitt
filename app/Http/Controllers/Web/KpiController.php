<?php

namespace App\Http\Controllers\Web;

use App\Services\KpiService;
use function dd;
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
        try
        {
            $result=$this->service->index($request);

            $data['kpiSet'] = $result->data;

            return view('app.kpi.index', $data);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function show($kpi_id){
        try{
            $result=$this->service->show($kpi_id);
            return response()->json($result);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response);
        }
    }

    public function create(Request $request){
        try{
            $result=$this->service->create($request->all());
            return redirect()->back();
            return response()->json($result);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response);
        }
    }

    public function update(Request $request,$kpi_id){
        try{
            $result=$this->service->update($request->all(),$kpi_id);
            return redirect()->back();
            return response()->json($result);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response);
        }
    }

    public function delete($kpi_id,$user_id){
        try{
            $result=$this->service->delete($kpi_id,$user_id);
            return response()->json($result);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response);
        }
    }

    public function addDataPoint(Request $request){
//        dd($request->all());
        try{
            $result=$this->service->addDataPoint($request->all());
            return redirect()->back();
        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function updateDataPoint(Request $request, $kpiId, $dataId){
//        dd($request->all());
        try{
            $result=$this->service->updateDataPoint($request->all(), $dataId);
            return redirect()->back();
        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function filterDataPoint(Request $request){
        try{
            $result=$this->service->filterDataPoint($request);
            return response()->json($result);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response);
        }
    }

    public function deleteDataPoint($kpiId,$dataId){
        try{

//            dd($kpiId, $dataId);
            $result=$this->service->deleteDatapoint($dataId);
            return redirect()->back();
            return response()->json($result);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response);
        }
    }
}

<?php

namespace App\Http\Controllers\Web;

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

    public function create(Request $request){
        try{
            $query=$this->service->create($request->all());
            return redirect(url('projects').'/'.$request->get('project_id').'/reports/'.$query->id);
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function view($project_id,$report_id){
        $data['page']='projects';
        $report=$this->service->show($report_id);
        $data['project_id']=$project_id;
        $data['report']=$report;
        $data['report_category']=$report->lean_tool_id;
        $data['report_data']=$this->getReport($data['report_category'],$report_id);
        return view('app.projects.reports.view',$data);
    }

    protected function getReport($report_category,$report_id){
        switch($report_category){
            case 16:
            case 18:
            case 19:
            case 20:
               return $this->service->showChartData($report_id);
               break;
            default:
                return null;
                break;
        }
    }

    public function storeChartData(Request $request){
        if($request->has('chart_id') && !empty($request->chart_id)){
            try{
                $this->service->updateChartData($request->all(),$request->chart_id);
                return redirect()->back()->with('success','Data has been updated');
            }catch (\Exception $e){
                return redirect()->back()->withErrors([$e->getMessage()]);
            }
        }
        else{
            try{
                $this->service->createChartData($request->all());
                return redirect()->back()->with('success','Data has been added');
            }catch (\Exception $e){
                return redirect()->back()->withErrors([$e->getMessage()]);
            }
        }
    }

    public function updateChartData($request,$chart_id){

    }

    public function removeChartData($chart_id){
        try{
            $this->service->deleteChartData($chart_id);
            return redirect()->back()->with('success','Data has been deleted');
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function changeChartAxis(Request $request,$report_id){
        try{
            $this->service->changeChartAxis($request->all(),$report_id);
            return redirect()->back()->with('success','Axis has been updated');
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
}

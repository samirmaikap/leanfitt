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
        $report=$this->service->show($report_id);
        $data['project_id']=$project_id;
        $data['report']=$report;
        $data['report_category']=$report->report_category_id;
        $data['report_data']=$this->getReport($data['report_category'],$report_id);
//        dd($data);
        return view('app.projects.reports.view',$data);
    }

    protected function getReport($report_category,$report_id){
        switch($report_category){
            case 14:
            case 11:
            case 12:
            case 6:
            case 15:
               return $this->service->showChartData($report_id);
               break;
            default:
                return null;
                break;
        }
    }

    public function storeChartData(Request $request){
        try{
           $this->service->createChartData($request->all());
           return redirect()->back()->with('success','Data has been added');
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function updateChartData(Request $request,$chart_id){
        try{
            $this->service->updateChartData($request->all(),$chart_id);
            return redirect()->back()->with('success','Data has been updated');
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function removeChartData($chart_id){
        try{
            $this->service->deleteChartData($chart_id);
            return redirect()->back()->with('success','Data has been deleted');
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function changeChartAxis(Request $request){
        try{
            $this->service->changeChartAxis($request->all());
            return redirect()->back()->with('success','Axis has been updated');
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
}

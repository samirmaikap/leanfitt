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
        $data['category_id']=$report->id;
        $data['report']=$this->getReport($report_id);
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
}

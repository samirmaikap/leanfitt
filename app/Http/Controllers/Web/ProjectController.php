<?php

namespace App\Http\Controllers\Web;

use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use App\Services\KpiService;

class ProjectController extends Controller
{

    protected $projectService;
    protected $kpiService;

    public function __construct(ProjectService $projectService, KpiService $kpiService)
    {
        $this->projectService=$projectService;
        $this->kpiService = $kpiService;
    }

    public function index(Request $request){
        $data['projects'] = $this->projectService->index($request);
        return view("app.projects.index", $data);
    }

    public function show($project_id)
    {
//        $data['project']=$this->projectService->show($project_id);
        $data['project']=null;
        return view("app.projects.details", $data);
    }

    public function members($project_id)
    {
        try
        {
            $result=$this->projectService->show($project_id);
            $data['project'] = $result->data;
            return view("app.projects.members", $data);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function kpi(Request $request, $project_id)
    {
        try
        {
            $result = $this->projectService->show($project_id);
            $data['project'] = $result->data;

            $result = $this->kpiService->index($request);
            $data['kpiSet'] = $result->data;

//            dd($data);

            return view("app.projects.kpi", $data);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function actionItems($project_id)
    {
        try
        {
            $result=$this->projectService->show($project_id);
            $data['project'] = $result->data;
            return view("app.projects.action-items", $data);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function reports($project_id)
    {
        try
        {
            $result=$this->projectService->show($project_id);
            $data['project'] = $result->data;
            return view("app.projects.reports", $data);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function create(Request $request){
        try{
            $result = $this->projectService->create($request);
            dd($result);
            return redirect()->back();
        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function update(Request $request,$project_id){
        try{
            $result=$this->projectService->update($request,$project_id);
            return response()->json($result);
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function archive($project_id,$user_id){
        try{
            $result=$this->projectService->archive($project_id,$user_id);
            return response()->json($result);
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function restore($project_id,$user_id){
        try{
            $result=$this->projectService->restore($project_id,$user_id);
            return response()->json($result);
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function complete($project_id,$user_id){
        try{
            $result=$this->projectService->complete($project_id,$user_id);
            return response()->json($result);
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function delete($project_id,$user_id){
        try{
            $result=$this->projectService->delete($project_id,$user_id);
            return response()->json($result);
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
}

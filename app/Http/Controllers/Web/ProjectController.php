<?php

namespace App\Http\Controllers\Web;

use App\Services\AttachmentService;
use App\Services\ProjectMemberService;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use App\Services\KpiService;

class ProjectController extends Controller
{

    protected $projectService;
    protected $kpiService;
    protected $memberService;
    protected $attachmentService;

    public function __construct(ProjectService $projectService,
                                KpiService $kpiService,
                                ProjectMemberService $projectMemberService,
                                AttachmentService $attachmentService)
    {
        $this->projectService=$projectService;
        $this->kpiService = $kpiService;
        $this->memberService=$projectMemberService;
        $this->attachmentService=$attachmentService;
    }

    public function index(Request $request){
        $organization=$request->query('organization') ? $request->get('organization') : pluckSession('id');
        $data['projects'] = $this->projectService->index($organization);

        return view("app.projects.index", $data);
    }

    public function show($project_id)
    {
        $data['project']=$this->projectService->show($project_id);
        $members=$this->projectService->getMembers($project_id);
        if(count($data['project']->member) > 0 && count($members) > 0){
            $existing_member=$data['project']->member->pluck('user_id')->toArray();
            $data['members']=$members->filter(function($item) use($existing_member){
                return !in_array($item->id,$existing_member);
            });
        }
        else{
            $data['members']=$members;
        }

        $project_members=$this->memberService->allMembers($project_id);
        $data['project_members']=$project_members->groupBy('role');
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
            $this->projectService->create($request->all());
            return redirect()->back()->with('success','New Project has been added');
        }catch(\Exception $e){
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
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

    /*New*/
    public function addMember(Request $request){
        try{
            $this->memberService->create($request->all());
            return redirect()->back()->with('success','New member has been added');
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function removeMember($project_id,$member_id){
        try{
            $this->memberService->delete($project_id,$member_id);
            return redirect()->back()->with('success','Member has been removed');
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function addAttachment(Request $request){
        $file=$request->hasFile('attachment') ? $request->file('attachment') : null;
        try{
            $this->attachmentService->create($request->all(),$file);
            return redirect()->back()->with('success','Attachment has been added');
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
}

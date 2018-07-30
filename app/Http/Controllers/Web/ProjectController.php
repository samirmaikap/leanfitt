<?php

namespace App\Http\Controllers\Web;

use App\Services\AttachmentService;
use App\Services\CommentService;
use App\Services\DepartmentService;
use App\Services\OrganizationService;
use App\Services\ProjectMemberService;
use App\Services\ReportService;
use App\Services\UserService;
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
    protected $commentService;
    protected $orgService;
    protected $reportService;
    protected $depService;
    protected $userService;

    public function __construct(ProjectService $projectService,
                                KpiService $kpiService,
                                ProjectMemberService $projectMemberService,
                                AttachmentService $attachmentService,
                                CommentService $commentService,
                                OrganizationService $organizationService,
                                ReportService $reportService,
                                DepartmentService $departmentService,
                                UserService $userService)
    {
        $this->projectService=$projectService;
        $this->kpiService = $kpiService;
        $this->memberService=$projectMemberService;
        $this->attachmentService=$attachmentService;
        $this->commentService=$commentService;
        $this->orgService=$organizationService;
        $this->reportService=$reportService;
        $this->userService=$userService;
        $this->depService=$departmentService;
    }

    public function index(Request $request){
        $data['page']='projects';
        $data['organizations']=$this->orgService->list();
        $data['department_id']=$request->get('department');
//        if(!isAdmin() && !isSuperadmin()){
//            $data['user_id']=session()->get('user')->id;
//        }
//        else{
//            $data['user_id']=$request->get('user');
//        }

        $data['user_id']=$request->get('user');

        $organization=!empty(pluckOrganization('id')) ? pluckOrganization('id') : $data['organizations']->first()->id;
        $data['organization_id']=$request->query('organization') ? $request->get('organization') : $organization;

        $data['departments']=$this->depService->list($request->all());
        $data['users']=$this->userService->list($data['organization_id'],$data['department_id']);


        $data['projects'] = $this->projectService->index($data['organization_id'],$data['department_id'],$data['user_id']);

        return view("app.projects.index", $data);
    }

    public function show($project_id)
    {
        $data['page']='projects';
        $data['sub_page']='details';
        $data['project']=$this->projectService->show($project_id);
        $members=$this->projectService->getMembers($project_id);
        if(count($data['project']->members) > 0 && count($members) > 0){
            $existing_member=$data['project']->members->pluck('user_id')->toArray();
            $data['members']=$members->filter(function($item) use($existing_member){
                return !in_array($item->id,$existing_member);
            });
        }
        else{
            $data['members']=$members;
        }

        $project_members=$this->memberService->allMembers($project_id);
        $data['project_members']=$project_members->groupBy('role');

        $savings=$this->projectService->getSavings($project_id);
        $data['tangibles']=$savings->where('type','tangible');
        $data['intangibles']=$savings->where('type','intangible');

        return view("app.projects.details", $data);
    }

    public function kpi(Request $request, $project_id)
    {
        try
        {
            $data['project'] = $this->projectService->show($project_id);
            $data['kpiSet'] = $this->kpiService->index($project_id);
            $data['sub_page'] = 'kpi';
            $data['page'] = 'projects';
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
            $data['project'] = $this->projectService->show($project_id);
            $data['sub_page'] = 'action-items';
            $data['page'] = 'projects';
//            dd($data);
            return view("app.projects.action-items", $data);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function reports($project_id)
    {

        $data['project'] = $this->projectService->show($project_id);
        $data['page'] = 'reports';
        $data['reports']=$this->reportService->index($project_id);
        $data['categories']=$this->reportService->names();
        return view("app.projects.reports", $data);
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
            $this->projectService->update($request->all(),$project_id);
            return redirect()->back()->with('success','Project has been updated');
        }catch(\Exception $e){
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
        }
    }

    public function archive($project_id){
        try{
            $result=$this->projectService->archive($project_id);
            return redirect()->back()->with('success','Project has been archived');
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function complete($project_id){
        try{
            $result=$this->projectService->complete($project_id);
            return redirect()->back()->with('success','Project has been completed');
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function delete($project_id){
        try{
            $result=$this->projectService->delete($project_id);
            return redirect()->back()->with('success','Project has been deleted');
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

    public function removeAttachment($project_id,$attachment_id){
        try{
            $this->attachmentService->delete($attachment_id);
            return redirect()->back()->with('success','Attachment has been deleted');
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function addComment(Request $request){
        try{
            $this->commentService->create($request->all());
            return redirect()->back()->with('success','Comment has been posted');
        }catch(\Exception $e){
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
        }
    }

    public function removeComment($comment_id){
        try{
            $this->commentService->delete($comment_id);
            return redirect()->back()->with('success','Comment has been deleted');
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function saveTangibles(Request $request,$project_id){
        try{
            $this->projectService->saveTangibles($request->all(),$project_id);
            return redirect()->back()->with('success','Tangibles has been updated');
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }

    }

    public function saveIntangibles(Request $request,$project_id){
        try{
            $this->projectService->saveIntangibles($request->all(),$project_id);
            return redirect()->back()->with('success','Intangibles has been udpated');
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Events\UsersUpdated;
use App\Http\Resources\UserResource;
use App\Services\DepartmentService;
use App\Services\OrganizationService;
use App\Services\RoleService;
use App\Services\UserService;
use function auth;
use function compact;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function json_decode;
use function json_encode;
use function response;

class UserController extends Controller
{
    protected $userService;
    protected $departmentService;
    protected $roleService;
    protected $orgService;

    public function __construct(UserService $userService,
                                OrganizationService $organizationService,
                                DepartmentService $departmentService,
                                RoleService $roleService)
    {
        $this->userService = $userService;
        $this->departmentService = $departmentService;
        $this->orgService=$organizationService;
        $this->roleService=$roleService;
    }

    public function index(Request $request, $activeOrganization = null)
    {
        $data['page']='users';
        $organizationId = null;
        $departmentId = null;
        $roleId = null;
        $data['orglist']=$this->orgService->list();
        $orglist=empty($data['orglist']) ? null : $data['orglist']->pluck('id')->toArray();
        $firstOrg=array_shift($orglist);

        if($request->query('organization'))
        {
            $organizationId = $request->query('organization');
        }
        elseif (!empty($activeOrganization))
        {
            $organizationId = $activeOrganization->id;
        }
        else{
            $organizationId=$firstOrg;
        }

        if($request->query('department'))
        {
            $departmentId = $request->query('department');
        }

        if($request->query('role'))
        {
            $roleId = $request->query('role');
        }



        $data['users'] = $this->userService->all($organizationId, $departmentId, $roleId);
//        $data['departments'] = $this->departmentService->allDepartments();
        $data['rolelist'] = $this->roleService->all($organizationId);
        $sessionOrg=$request->query('organization') ? $request->get('organization') : $firstOrg;
        $data['activeorg']=empty($sessionOrg) ? pluckOrganization('id') : $sessionOrg;
        $data['activedep']=$request->get('department');
        $data['activerole']=$request->get('role');

        //$data['users']=$this->userService->all($request->all()); //Fetch from the earlier service method

        $data['deplist']=$this->departmentService->list($request->all());

        return view('app.users.index', $data);

    }

    public function invitation(Request $request){
        try{
            $this->userService->invitaton($request->all());
            return redirect()->back()->with(['success' => 'An inviation has been sent']);
        }catch(\Exception $e){
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try
        {
            $data['organizations'] = $this->userService->create($request->all());
            return redirect()->back()->with(['success' => 'User has been added successfully']);
        }
        catch(\Exception $e)
        {
//            dd($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
        }
    }

    public function profile(Request $request,$user_id)
    {
        $organizationId=$request->has('organization') ? $request->get('organization') : pluckOrganization('id');
        $data['user']=$this->userService->profile($user_id);
        $data['departments']=$this->departmentService->list($request->all());
        $data['roles']=$this->roleService->all($organizationId);
        return view('app.users.profile', $data);
    }

    public function reInvitation($user_id){
        try{
            $this->userService->reInvite($user_id);
            return redirect()->back()->with(['success' => 'An inviation has been sent']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {

        try
        {
            $image=$request->hasFile('image') ? $request->file('image') : null;
            $this->userService->update($request->all(),$image,$id);
            session()->forget('user');
            session()->put('user',auth()->user());
            return redirect()->back()->with(['success' => 'Profile has been updated successfully']);
        }
        catch(\Exception $e)
        {
//            dd($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
        }
    }

    public function delete(Request $request, $id)
    {
        try
        {
            $this->userService->delete($id);
            $event['organization_id']=pluckOrganization('id');
            event(new UsersUpdated($event));
            return redirect()->back()->with(['success' => 'User has been deleted successfully']);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
        }
    }

    public function suspend($user_id)
    {
        try
        {
            $this->userService->suspend($user_id);
            return redirect()->back()->with(['success' => 'User has been suspended']);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function restore($user_id)
    {

        try
        {
            $this->userService->restore($user_id);
            return redirect()->back()->with(['success' => 'User has been restored']);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers\Web;

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
    protected $rolesService;
    protected $orgService;
    protected $roleService;

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

    public function index(Request $request)
    {

//        $data['users'] = $this->userService->all($request->all());
//        $data['departments'] = $this->departmentService->allDepartments();
//        $data['roles'] = [];

        $data['page']='Quiz';
        $data['activeorg']=$request->get('organization');
        $data['activedep']=$request->get('department');

        $data['users']=$this->userService->all($request->all());

        $data['orglist']=$this->orgService->list();
        if(!empty($request->get('organization'))){
            $data['deplist']=$this->departmentService->list($request->all());
        }
        else{
            $data['deplist']=null;
        }

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
        $data['Page']='profile';
        $data['user']=$this->userService->profile($user_id);
        $data['departments']=$this->departmentService->list($request->all());
//        $data['roles']=$this->roleService->all();
        return view('app.users.view', $data);
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
        $this->userService->update($request->all(),'',$id);
        return redirect()->back()->with(['success' => 'Profile has been updated successfully']);
        try
        {
//            $this->userService->update($request->all(), $id);
//            return redirect()->back()->with(['success' => 'Profile has been updated successfully']);
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
            return redirect()->back()->with(['success' => 'User has been deleted successfully']);
        }
        catch(\Exception $e)
        {
            dd($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
        }
    }
}

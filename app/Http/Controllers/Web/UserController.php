<?php

namespace App\Http\Controllers\Web;

use App\Http\Resources\UserResource;
use App\Services\DepartmentService;
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

    public function __construct(UserService $userService, DepartmentService $departmentService)
    {
        $this->userService = $userService;
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        $data['users'] = json_decode(json_encode(UserResource::collection($this->userService->all())));
        $data['departments'] = $this->departmentService->allDepartments();
        $data['roles'] = [];
        return view('app.users.index', $data);


    }

    public function create()
    {

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

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        try
        {
            $data['organizations'] = $this->userService->update($request->all(), $id);
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
            return redirect()->back()->with(['success' => 'User has been deleted successfully']);
        }
        catch(\Exception $e)
        {
            dd($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
        }
    }
}

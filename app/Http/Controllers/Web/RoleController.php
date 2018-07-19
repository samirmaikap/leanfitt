<?php

namespace App\Http\Controllers\Web;

use App\Services\RoleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(Request $request, $organization = null)
    {
        $data['roles'] = $this->roleService->all($organization);
        return view('app.roles.index', $data);
    }

    public function create()
    {

    }

    public function store(Request $request, $organization = null)
    {
        try
        {
            $this->roleService->create($request->all(), $organization);
            return redirect()->back()->with(['success' => 'Role has been created successfully']);
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
            $this->roleService->update($request->all(), $id);
            return redirect()->back()->with(['success' => 'Role has been updated successfully']);
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
            $this->roleService->delete($id);
            return redirect()->back()->with(['success' => 'Role has been deleted successfully']);
        }
        catch(\Exception $e)
        {
            dd($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
        }
    }
}

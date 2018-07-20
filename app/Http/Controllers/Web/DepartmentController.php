<?php

namespace App\Http\Controllers\Web;

use App\Services\DepartmentService;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index(Request $request)
    {
        $data['departments'] = $this->departmentService->allDepartments();
        return view('app.departments.index', $data);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        try
        {
            if(!empty($request->get('department_id'))){
                $this->departmentService->updateDepartment($request->all(), $request->get('department_id'));
                return redirect()->back()->with(['success' => 'Department has bee updated successfully']);
            }
            else{
                $this->departmentService->createDepartment($request->all());
                return redirect()->back()->with(['success' => 'Department has been added successfully']);
            }

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
            $data['organizations'] = $this->departmentService->updateDepartment($request->all(), $id);
            return redirect()->back()->with(['success' => 'Department has been updated successfully']);
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
            $this->departmentService->removeDepartment($id);
            return redirect()->back()->with(['success' => 'Department has been deleted successfully']);
        }
        catch(\Exception $e)
        {
            dd($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
        }
    }
}

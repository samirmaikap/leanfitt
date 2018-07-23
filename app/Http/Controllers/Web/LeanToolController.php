<?php

namespace App\Http\Controllers\Web;

use App\Services\LeanToolService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeanToolController extends Controller
{
    protected $service;
    public function __construct(LeanToolService $leanToolService)
    {
        $this->service=$leanToolService;
    }

    public function index(){
        $data['page']='lean-tools';
        $data['tools']=$this->service->index();
        return view('app.leantools.index',$data);
    }

    public function show($tool_id){
        $data['page']='lean-tools';
        $data['tool']=$this->service->show($tool_id);
        return view('app.leantools.view',$data);
    }

    public function create($tool_id=null){
        $data['page']='lean-tools';
        $data['title']='New Lean Tool';
        $data['tool_id']=$tool_id;
        if(!empty($tool_id)){
            $data['tool']=$this->service->show($tool_id);
        }
        else{
            $data['tool']=null;
        }
        return view('app.leantools.create',$data);
    }

    public function save(Request $request){
         $data['quiz']=!empty($request->get('quiz')) ? json_encode(array_values($request->get('quiz'))) : null;
         $data['assessment']=!empty(json_encode($request->get('assessment'))) ? json_encode($request->get('assessment')) : null;
         $data['steps']=$request->get('steps');
         $data['overview']=$request->get('overview');
         $data['case_studies']=$request->get('case_studies');
         $data['name']=$request->get('name');
         try{
             if(!empty($request->tool_id)){
                 $this->service->update($data,$request->tool_id);
                 return redirect()->back()->with('success', 'Leantool has been updated');
             }
             else{
                 $this->service->create($data);
                 return redirect()->back()->with('success', 'Leantool hasss been added');
             }

         }catch (\Exception $e){
             return redirect()->back()->withErrors([$e->getMessage()]);
         }

    }
}

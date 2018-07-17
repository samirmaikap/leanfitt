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
        $query=$this->service->index();

        $data['tools']=$query->success ? $query->data : null;
        return view('app.leantools.index',$data);
    }

    public function show($tool_id){
        $query=$this->service->show($tool_id);
        $data['tool']=$query->success ? $query->data : null;
        return view('app.leantools.view',$data);
    }

    public function create($domain,$tool_id=null){
        $data['page']='lean_create';
        $data['title']='New Lean Tool';
        $data['tool_id']=$tool_id;
        if(!empty($tool_id)){
            $tool=$this->service->show($tool_id);
            if($tool->success){
                $data['tool']=$tool->data;
            }
            else{
                $data['tool']=null;
            }
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
         $new_request=new Request($data);
         try{
             if(!empty($request->tool_id)){
                 $query=$this->service->update($new_request,$request->tool_id);
             }
             else{
                 $query=$this->service->create($new_request);
             }
             if($query->success){
                 return redirect()->back()->with('success', $query->message);
             }
             else{
                 return redirect()->back()->withErrors([$query->message]);
             }
         }catch (\Exception $e){
             return redirect()->back()->withErrors([$e->getMessage()]);
         }

    }
}

<?php

namespace App\Http\Controllers\API;

use App\Services\AwardService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AwardController extends Controller
{
    protected $service;
    public function __construct(AwardService $awardService)
    {
        $this->service=$awardService;
    }

    public function index(Request $request){
        try{
            $result=$this->service->index($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function __construct()
    {
    }

    public function intangibles(Request $request){
        $values=explode(',',$request->value);
        $intangibles=collect($values)->map(function($item){
            return ucfirst($item);
        })->values()->toArray();
        $value=array('values'=>$intangibles);
        if(Storage::disk('local')->put('savings.json',json_encode($value))){
            return redirect()->back()->with('success','Keywords has been updated');
        }
        else{
            return redirect()->back()->withErrors([config('messages.common_error')]);
        }

    }
}

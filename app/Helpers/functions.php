<?php
function arrayValue($array,$key){
    if(!is_array($array))
        return null;
    if(array_key_exists($key,$array)){
        return $array[$key];
    }
    else{
        return null;
    }
}

function renderError($message){
    $response['success']=false;
    $response['data']=null;
    $response['message']=$message;
    return response()->json($response,400);
}

function renderSuccess($data,$message,$status){
    $response['success']=true;
    $response['data']=$data;
    $response['message']=$message;
    return response()->json($response,$status);
}


function renderCollection($data){
    if($data instanceof \Illuminate\Database\Eloquent\Collection){
        return $data;
    }
    else{
        return new \Illuminate\Database\Eloquent\Collection($data);
    }
}
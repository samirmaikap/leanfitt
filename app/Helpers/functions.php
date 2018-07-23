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
        return json_decode(json_encode(new \Illuminate\Database\Eloquent\Collection($data)));
    }
}

function pluckSession($key){
    $session=session()->get('organization');
    if($session){
        return $session->$key;
    }
    return null;
}

function isSuperadmin(){
    return session('is_superadmin')==1 ? true : false;
}

function isAdmin(){
    $session=session()->get('is_admin');
    if($session){
        return session('is_admin');
    }
    else{
        return false;
    }
}
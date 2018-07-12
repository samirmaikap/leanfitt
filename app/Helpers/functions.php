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

function errorMessage($message){
    $response['success']=false;
    $response['data']=null;
    $response['message']=$message;
    return response()->json($response,400);
}

function successMessage($data,$message_code,$status){
    $response['success']=true;
    $response['data']=$data;
    $response['message']=config('messages.'.$message_code);
   return response()->json($response,$status);
}
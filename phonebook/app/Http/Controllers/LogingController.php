<?php

namespace App\Http\Controllers;
use Firebase\JWT\JWT;
use Firebase\JWT\Key; 
use App\Models\Registration;
use Illuminate\Http\Request;

class LogingController extends Controller
{
  function tokenTest(){   //token pass hoche ki na seta test
    return "Token Is Ok";
  }
  
  function onloging(Request $request){
    $username =$request->input('username');
    $password=$request->input('password');
    $userCount=Registration::where(['username'=>$username,'password'=>$password])->count();
    if($userCount==1){
        $key = env('TOKEN_KEY');
        $payload = [
            'site' => 'http://demo.com',
            'user' => $username,
            'iat' => time(),
            'exp' => time()+3600
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');
        return response()->json(['Token'=>$jwt,'Status'=>'Login Success']);
    }
    else{
        return "wrong Username Password";
    }
  }
}
